<?php

namespace App\Weather\Fetcher;

use App\Weather\Model\Weather;

interface FetcherInterface
{
    public function fetchWeather(): Weather;

    public static function getPlace(): string;
}
