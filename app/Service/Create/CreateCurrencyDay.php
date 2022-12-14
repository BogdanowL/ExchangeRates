<?php

namespace App\Service\Create;

use App\Models\CurrencyDay;

class CreateCurrencyDay
{
    public function run(string $day)
    {
       $currencyDay = app(CurrencyDay::class);
       $currencyDay->day = $day;
       $currencyDay->save();

       return $currencyDay;
    }
}
