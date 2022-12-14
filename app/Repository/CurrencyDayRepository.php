<?php

namespace App\Repository;

use App\Models\CurrencyDay;

class CurrencyDayRepository
{

    public function findByDay(string $day)
    {
        return CurrencyDay::where(CurrencyDay::DAY_COLUMN, $day)->first();
    }

    public function getVibrations(string $day)
    {
        $day = $this->findByDay($day);
        if(!$day){
           return [];
        }
        return $day->rates->pluck('value', 'char_code');
    }
}
