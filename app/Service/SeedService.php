<?php

namespace App\Service;

use App\DTO\CurrencyRateDTO;
use App\Jobs\CreateRatesForDay;
use App\Models\CurrencyRate;
use App\Repository\CurrencyDayRepository;
use App\Service\Interfaces\IApiService;
use App\Service\Interfaces\ISeedService;
use Carbon\Carbon;

class SeedService extends AbstractSeed
{
    public function getDayRates(array $currencyRate, int $dayId = 0)
    {
       return array_map(function ($rate) use ($dayId){

           $currencyValue = str_replace(',', '.', $rate['Value']);

            return new CurrencyRateDTO(
                (int)$dayId,
                (string)$rate['@attributes']['ID'],
                (int)$rate['NumCode'],
                (string)$rate['CharCode'],
                (int)$rate['Nominal'],
                (string)$rate['Name'],
                (float)$currencyValue,
            );
        }, $currencyRate);
    }

    public function computeVibrations(array $todayRates)
    {
        $yesterday = Carbon::now()->subDays(AbstractSeed::YESTERDAY)->format('d/m/Y');
        $yesterdayRate = $this->dayRepository->getVibrations($yesterday);

        if (empty($yesterdayRate)){
            app(CreateRatesForDay::class)->run($yesterday);
            $yesterdayRate = $this->dayRepository->getVibrations($yesterday);
        }

        if ($yesterdayRate->count() < ISeedService::COUNT_CURRENCIES ){
            return $this->computeVibrations($todayRates);
        }

        if ($yesterdayRate->count() > 0){
            return array_map(function ($rate) use ($yesterdayRate){
                $yesterdayValue = $yesterdayRate[$rate['charCode']];
                $todayValue = $rate['value'];
                $exchangeRate = $todayValue - $yesterdayValue;
                if ($exchangeRate > 0){
                    $rate['vibration'] = [ CurrencyRate::RATE_UP => $exchangeRate];
                }else{
                    $rate['vibration'] = [ CurrencyRate::RATE_DOWN => $exchangeRate];
                }
                return $rate;
            }, $todayRates);
        }
    }
}

