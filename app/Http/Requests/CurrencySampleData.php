<?php

namespace App\Http\Requests;

use Spatie\LaravelData\Data;

class CurrencySampleData extends Data
{
    public function __construct(
        public array $rates
    ) {
    }
}
