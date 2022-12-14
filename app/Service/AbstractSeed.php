<?php

namespace App\Service;

use App\DTO\CurrencyRateDTO;
use App\Repository\CurrencyDayRepository;
use App\Service\Interfaces\IApiService;
use App\Service\Interfaces\ISeedService;
use Carbon\Carbon;

abstract class AbstractSeed implements ISeedService
{
    public const YESTERDAY = 1;

    public function __construct(protected IApiService $apiService,
                                protected CurrencyDayRepository $dayRepository)
    {
    }
    public function getRates(string $day)
    {
        return $this->apiService->callForDay($day);
    }

    abstract public function getDayRates(array $currencyRate, int $dayId = 0);

    public function getDays(int $countDays): array
    {
        $out = [];
        for ($lastDay = 0; $lastDay < $countDays; $lastDay++){
            $day = Carbon::now()->subDays($lastDay)->format('d/m/Y');
            $out[] = $day;
        }

       return $out;
    }

    public function mapDtoToArray(array $array)
    {
       return array_map(fn($dto) => $dto->toArray(), $array);
    }

    public function sortNameCurrency($dto)
    {
        $out = [];
        foreach ($dto as $currency){
            $out[$currency->charCode] = $currency;
        }
        return $out;
    }
}
