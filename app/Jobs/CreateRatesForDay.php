<?php

namespace App\Jobs;

use App\Service\Create\CreateCurrencyDay;
use App\Service\Interfaces\ISeedService;

class CreateRatesForDay
{
    public function __construct(private ISeedService $seedService)
    {
    }

    public function run(string $day)
    {
        $currencyDay = app(CreateCurrencyDay::class)->run($day);
        $dayRates = $this->seedService->getRates($currencyDay->day);
        $data = $dayRates['Valute'];
        $ratesDayDto = $this->seedService->getDayRates($data, $currencyDay->id);
        foreach ($ratesDayDto as $dayRate){
            CreateCurrencyRateJob::dispatch($dayRate);
        }

        return $currencyDay;
    }
}
