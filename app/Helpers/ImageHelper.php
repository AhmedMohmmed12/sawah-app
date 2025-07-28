<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get the proper URL for an image, handling both external URLs and local storage files
     */
    public static function getImageUrl($imagePath)
    {
        if (empty($imagePath)) {
            return null;
        }

        // If it's already a full URL (external image), return as is
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        // If it's a local file path, use Storage::url
        return Storage::url($imagePath);
    }

    /**
     * Check if the image is an external URL
     */
    public static function isExternalUrl($imagePath)
    {
        return filter_var($imagePath, FILTER_VALIDATE_URL);
    }

    /**
     * Get a placeholder image URL
     */
    public static function getPlaceholderUrl($type = 'general')
    {
        $placeholders = [
            'country' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=600&fit=crop',
            'attraction' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop',
            'hotel' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop',
            'general' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800&h=600&fit=crop',
        ];

        return $placeholders[$type] ?? $placeholders['general'];
    }
} 