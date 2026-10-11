<?php

use App\Models\Country;
use App\Models\User;
use Database\Seeders\AttractionSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\HotelSeeder;

beforeEach(function () {
    $this->seed([CountrySeeder::class, AttractionSeeder::class, HotelSeeder::class]);
});

test('seed data covers every country with photos and credits', function () {
    expect(Country::count())->toBe(22);

    Country::with(['hotels', 'attractions'])->get()->each(function (Country $country) {
        expect($country->hotels)->toHaveCount(3)
            ->and($country->attractions)->toHaveCount(4)
            ->and($country->image_credit)->not->toBeNull()
            ->and(file_exists(public_path($country->image)))->toBeTrue();
    });
});

test('seeders can run twice without duplicating rows', function () {
    $this->seed([CountrySeeder::class, AttractionSeeder::class, HotelSeeder::class]);

    expect(Country::count())->toBe(22)
        ->and(App\Models\Hotel::count())->toBe(66)
        ->and(App\Models\Attraction::count())->toBe(88);
});

test('public pages load for guests', function (string $url) {
    $this->get($url)->assertOk();
})->with([
    '/',
    '/destinations',
    '/destinations?climate=Cold&max_budget=1000',
    '/destinations/japan',
    '/hotels',
    '/hotels?country=italy&stars=5',
    '/things-to-do?type=Beach',
    '/photo-credits',
]);

test('old country urls redirect to the slug', function () {
    $japan = Country::where('slug', 'japan')->first();

    $this->get("/country/{$japan->id}")->assertRedirect('/destinations/japan');
});

test('unknown countries return 404', function () {
    $this->get('/destinations/atlantis')->assertNotFound();
});

test('guests are sent to sign in before seeing planner results', function () {
    $this->get('/find-destination?budget_min=300&budget_max=800')->assertRedirect('/login');
});

test('trip planner only returns countries whose budget overlaps and climate matches', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/find-destination?budget_min=150&budget_max=300&weather=Warm&trip_type=Relaxation');

    $response->assertOk();
    $names = $response->viewData('results')->map(fn ($r) => $r->country->name);

    expect($names)->toContain('Thailand', 'Egypt')
        ->not->toContain('Switzerland', 'Maldives', 'Georgia');

    expect($user->fresh()->search_count)->toBe(1);
});

test('trip planner falls back to the closest options when nothing fits', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/find-destination?budget_min=10&budget_max=20&weather=Cold');

    $response->assertOk()->assertSee('No exact matches');
    expect($response->viewData('relaxed'))->toBeTrue();
});

test('managers cannot use the traveller planner', function () {
    $manager = User::factory()->create(['role' => 'manager']);

    $this->actingAs($manager)->get('/suggest-destination')->assertForbidden();
});
