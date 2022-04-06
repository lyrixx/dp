<?php

namespace App\Weather\Fetcher;

use App\Weather\Model\Weather;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LondonFetcher implements FetcherInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function fetchWeather(): Weather
    {
        $data = $this
            ->httpClient
            ->request('GET', 'https://weather.titouangalopin.com/london.json')
            ->toArray()
        ;

        return new Weather(
            'London',
            $data['humidity'],
            $data['temperature'],
        );
    }

    public static function getPlace(): string
    {
        return 'london';
    }
}
