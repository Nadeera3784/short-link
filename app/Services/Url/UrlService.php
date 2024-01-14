<?php

namespace App\Services\Url;

use Illuminate\Support\Facades\Http;

class UrlService
{
     /**
     * Generate a URL based on the given identifier.
     *
     * @param string $identifier The unique identifier for the URL.
     *
     * @return string The generated URL.
     */
    public function generateUrl(string $identifier): string
    {
        return url('/') . '/' . $identifier;
    }

    /**
     * Check if the provided short URL is valid.
     *
     * @param string|null $shortUrl
     * @return bool
     */
    public function isValidShortUrl($shortUrl): bool
    {
        return $shortUrl && strlen($shortUrl) == 6;
    }

    /**
     * Perform a threat lookup for the given URL using the Yandex API.
     *
     * @param string $url
     * @return array
     */
    public function lookup($url)
    {
        $apiUrl = "https://sba.yandex.net/v4/threatMatches:find?key=" . config('services.yandex.key');


        $requestData = [
            'client' => [
                'clientId' => config('services.yandex.id'),
                'clientVersion' => config('services.yandex.version'),
            ],
            'threatInfo' => [
                'threatTypes' => ["MALWARE", "SOCIAL_ENGINEERING", "POTENTIALLY_HARMFUL_APPLICATION"],
                'platformTypes' => ["ALL_PLATFORMS"],
                'threatEntryTypes' => ["URL", "EXECUTABLE"],
                'threatEntries' => [
                    ['url' => $url],
                ],
            ],
        ];

        try {
            $response = Http::post($apiUrl, $requestData);
            if ($response->successful()) {
                return count($response->json()) > 0 ? $response->json() : ['matches' => []];
            } else {
                return ['error' => 'API request failed'];
            }
        } catch (\Exception $exception) {
            return ['error' => $exception->getMessage()];
        }
    }
}
