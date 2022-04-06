<?php

namespace App\Weather\Fetcher;

use App\Weather\Model\Weather;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BerlinFetcher implements FetcherInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function fetchWeather(): Weather
    {
        $data = $this
            ->httpClient
            ->request('GET', 'https://weather.titouangalopin.com/berlin.json')
            ->toArray()
        ;

        return new Weather(
            'Berlin',
            $data['measure']['humidity'],
            $data['measure']['temp'],
        );
    }

    public static function getPlace(): string
    {
        return 'berlin';
    }
}
