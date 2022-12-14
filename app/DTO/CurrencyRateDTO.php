<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class CurrencyRateDTO extends Data
{
    public function __construct(
        public int $currencyDayId,
        public string $currencyId,
        public int $numCode,
        public string $charCode,
        public int $nominal,
        public string $name,
        public float $value,
        public array $vibration = []
    ) {
    }
}
