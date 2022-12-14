<?php

namespace App\Service\Interfaces;

use App\Http\Requests\CurrencySampleData;

interface ISampleService
{
    public function sample(CurrencySampleData $dtoRates);
}
