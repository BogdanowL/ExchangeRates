<?php

namespace App\Service;

use App\Http\Requests\CurrencySampleData;
use App\Service\Interfaces\IApiService;
use App\Service\Interfaces\ISampleService;
use App\Service\Interfaces\ISeedService;

class SampleService implements ISampleService
{
    public function __construct(private IApiService $apiService,
                                private ISeedService $seedService)
    {
    }

    public function sample(CurrencySampleData $dtoRates)
    {
        $data = $this->apiService->callForToday();
        $data = $data['Valute'];
        $dto = $this->seedService->getDayRates($data);
        $charCodes = $dtoRates->rates;
        $needleRates = $this->needleRates($dto, $charCodes);

        return $this->seedService->mapDtoToArray($needleRates);
    }

    public function needleRates($dto, $charCodes)
    {
        $out = [];
        foreach ($dto as $currency){
            if (in_array($currency->charCode, $charCodes)){
                $out[] = $currency;
            }
        }
        return $out;
    }

}
