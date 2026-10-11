<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Downloads one freely licensed photo per country, attraction and hotel in
 * database/seeders/data/destinations.php from Wikimedia Commons, and records
 * the author and licence in database/seeders/data/image-credits.php.
 *
 * Each entry's "photo" is either a Wikipedia article title (its lead image is
 * used if it lives on Commons, otherwise Commons is searched for the title)
 * or an exact "File:..." name to pin a specific picture.
 */
class FetchSeedImages extends Command
{
    protected $signature = 'sawah:fetch-images
                            {--force : Download again even if the file already exists}
                            {--compress : Only recompress images already on disk}
                            {--only= : Only fetch keys containing this text, e.g. "hotels/the-savoy"}';

    protected $description = 'Download seed photos and credits from Wikimedia Commons';

    private const USER_AGENT = 'SawahSeeder/1.0 (https://sawah.habani.site; seed image fetcher)';

    private array $credits = [];

    public function handle(): int
    {
        $data = require database_path('seeders/data/destinations.php');
        $creditsPath = database_path('seeders/data/image-credits.php');
        $this->credits = file_exists($creditsPath) ? require $creditsPath : [];

        $jobs = [];
        foreach ($data as $country) {
            $jobs['countries/'.Str::slug($country['name'])] = [$country['photo'], 1600];
            foreach ($country['attractions'] as $a) {
                $jobs['attractions/'.Str::slug($a['name'])] = [$a['photo'], 900];
            }
            foreach ($country['hotels'] as $h) {
                $jobs['hotels/'.Str::slug($h['name'])] = [$h['photo'], 900];
            }
        }

        if ($only = $this->option('only')) {
            $jobs = array_filter($jobs, fn ($key) => str_contains($key, $only), ARRAY_FILTER_USE_KEY);
        }

        if ($this->option('compress')) {
            foreach ($jobs as $key => [, $width]) {
                if (file_exists($file = public_path("images/{$key}.jpg"))) {
                    $this->compress($file, $width);
                }
            }
            $this->info('Recompressed existing images.');

            return self::SUCCESS;
        }

        $missing = [];
        foreach ($jobs as $key => [$photo, $width]) {
            $target = public_path("images/{$key}.jpg");

            $current = $this->credits[$key]['photo'] ?? null;
            if (! $this->option('force') && file_exists($target) && $current === $photo) {
                continue;
            }

            $info = $this->resolve($photo, $width);
            if (! $info) {
                $missing[] = "{$key} ({$photo})";
                $this->warn("  no image: {$key}");
                continue;
            }

            $image = Http::withHeaders(['User-Agent' => self::USER_AGENT])->timeout(60)->retry(3, 2000)->get($info['thumburl']);
            if (! $image->successful()) {
                $missing[] = "{$key} (download failed)";
                continue;
            }

            if (! is_dir(dirname($target))) {
                mkdir(dirname($target), 0755, true);
            }
            file_put_contents($target, $image->body());
            $this->compress($target, $width);

            $meta = $info['extmetadata'] ?? [];
            $artist = trim(html_entity_decode(strip_tags($meta['Artist']['value'] ?? 'Unknown author')));
            $license = trim(strip_tags($meta['LicenseShortName']['value'] ?? 'see source'));

            $this->credits[$key] = [
                'photo' => $photo,
                'file' => $info['title'],
                'credit' => Str::limit(preg_replace('/\s+/', ' ', $artist), 60).' / '.$license,
                'source' => $info['descriptionurl'],
            ];

            $this->info("  {$key} <- {$info['title']}");
            $this->saveCredits($creditsPath);
            usleep(300_000);
        }

        $this->saveCredits($creditsPath);

        if ($missing) {
            $this->newLine();
            $this->error(count($missing).' missing:');
            foreach ($missing as $m) {
                $this->line("  {$m}");
            }

            return self::FAILURE;
        }

        $this->info('All images present.');

        return self::SUCCESS;
    }

    /** Find a Commons file for an article title or explicit File: name. */
    private function resolve(string $photo, int $width): ?array
    {
        if (str_starts_with($photo, 'File:')) {
            return $this->commonsInfo($photo, $width);
        }

        $page = $this->api('https://en.wikipedia.org/w/api.php', [
            'action' => 'query', 'prop' => 'pageimages', 'piprop' => 'name',
            'redirects' => 1, 'titles' => $photo,
        ]);
        $name = collect($page['query']['pages'] ?? [])->first()['pageimage'] ?? null;

        if ($name && ! preg_match('/\.(svg|png|gif)$/i', $name)) {
            $info = $this->commonsInfo('File:'.$name, $width);
            if ($info && $this->usable($info)) {
                return $info;
            }
        }

        $search = $this->api('https://commons.wikimedia.org/w/api.php', [
            'action' => 'query', 'generator' => 'search', 'gsrnamespace' => 6,
            'gsrsearch' => $photo.' filetype:bitmap', 'gsrlimit' => 15,
            'prop' => 'imageinfo', 'iiprop' => 'url|size|mime|extmetadata', 'iiurlwidth' => $width,
        ]);

        return collect($search['query']['pages'] ?? [])
            ->sortBy('index')
            ->map(fn ($p) => ($p['imageinfo'][0] ?? []) + ['title' => $p['title']])
            ->first(fn ($info) => $this->usable($info));
    }

    private function commonsInfo(string $file, int $width): ?array
    {
        $res = $this->api('https://commons.wikimedia.org/w/api.php', [
            'action' => 'query', 'titles' => $file,
            'prop' => 'imageinfo', 'iiprop' => 'url|size|mime|extmetadata', 'iiurlwidth' => $width,
        ]);
        $page = collect($res['query']['pages'] ?? [])->first();

        if (! $page || isset($page['missing']) || empty($page['imageinfo'][0])) {
            return null;
        }

        return $page['imageinfo'][0] + ['title' => $page['title']];
    }

    /** Landscape JPEG, big enough, freely licensed. */
    private function usable(array $info): bool
    {
        $license = strtolower($info['extmetadata']['LicenseShortName']['value'] ?? '');

        return ($info['mime'] ?? '') === 'image/jpeg'
            && ($info['width'] ?? 0) >= 1000
            && ($info['width'] ?? 0) >= ($info['height'] ?? 0)
            && ! str_contains($license, 'fair use')
            && ! empty($info['thumburl']);
    }

    /** Resize to the target width and re-encode, so the repo stays small. */
    private function compress(string $path, int $width): void
    {
        $src = @imagecreatefromstring(file_get_contents($path));
        if (! $src) {
            return;
        }

        if (imagesx($src) > $width) {
            $src = imagescale($src, $width);
        }

        imageinterlace($src, true);
        imagejpeg($src, $path, 78);
        imagedestroy($src);
    }

    private function api(string $url, array $params): array
    {
        $res = Http::withHeaders(['User-Agent' => self::USER_AGENT])
            ->timeout(30)
            ->retry(3, 2000)
            ->get($url, $params + ['format' => 'json', 'formatversion' => 1]);

        return $res->json() ?? [];
    }

    private function saveCredits(string $path): void
    {
        ksort($this->credits);
        file_put_contents($path, "<?php\n\n// Generated by `php artisan sawah:fetch-images`. Do not edit by hand.\n\nreturn ".var_export($this->credits, true).";\n");
    }
}
