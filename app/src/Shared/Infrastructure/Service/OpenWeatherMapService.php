<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

class OpenWeatherMapService
{
    private HttpClientInterface $client; // Tipo especificado
    private string $apiKey; // Tipo especificado
    private string $apiUrl; // Tipo especificado

    public function __construct(HttpClientInterface $client, string $apiKey, string $apiUrl)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return array<string, mixed>
     */
    public function getWeatherDataByCity(string $city): array
    {
        try {
            $response = $this->client->request('GET', $this->apiUrl, [
                'query' => [
                    'q' => $city,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                ],
            ]);

            $data = $response->toArray();

            return [
                'city' => $city,
                'temp_min' => $data['main']['temp_min'],
                'temp_max' => $data['main']['temp_max'],
            ];
        } catch (ExceptionInterface $e) {
            // Handle exception, e.g., log the error, return empty array, etc.
            return [
                'error' => 'City not found or API request failed.',
            ];
        }
    }
}
