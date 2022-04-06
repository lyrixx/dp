<?php

namespace App\Weather\Fetcher;

use App\Weather\Model\Weather;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ParisFetcher implements FetcherInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function fetchWeather(): Weather
    {
        $data = $this
            ->httpClient
            ->request('GET', 'https://weather.titouangalopin.com/paris.json')
            ->toArray()
        ;

        return new Weather(
            'Paris',
            $data['humidity'],
            $data['temperature'],
        );
    }

    public static function getPlace(): string
    {
        return 'paris';
    }
}
