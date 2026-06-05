<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    private Cloudinary $cloudinary;

    public function __construct()
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key'    => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $this->cloudinary = new Cloudinary();
    }

    /**
     * Upload a file and return its secure URL.
     */
    public function upload(UploadedFile $file, string $folder = 'portfolio'): string
    {
        $result = $this->cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder'          => $folder,
                'resource_type'   => 'image',
                'quality'         => 'auto:good',
                'fetch_format'    => 'auto',
            ]
        );

        return $result['secure_url'];
    }

    /**
     * Delete an asset by its public_id.
     */
    public function delete(string $publicId): void
    {
        $this->cloudinary->uploadApi()->destroy($publicId);
    }

    /**
     * Extract Cloudinary public_id from a secure URL.
     * e.g. https://res.cloudinary.com/demo/image/upload/v123/portfolio/abc.jpg
     *       → portfolio/abc
     */
    public static function publicIdFromUrl(string $url): ?string
    {
        if (!str_contains($url, 'cloudinary.com')) {
            return null;
        }
        // Strip everything up to and including /upload/vXXXXX/
        $pattern = '/\/upload\/(?:v\d+\/)?(.+)\.[a-z]+$/i';
        if (preg_match($pattern, $url, $m)) {
            return $m[1];
        }
        return null;
    }
}
