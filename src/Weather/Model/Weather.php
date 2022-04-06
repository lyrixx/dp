<?php

namespace App\Weather\Model;

class Weather
{
    public function __construct(
        public readonly string $place,
        public readonly float $humidity,
        public readonly float $temperature,
    ) {
    }
}
