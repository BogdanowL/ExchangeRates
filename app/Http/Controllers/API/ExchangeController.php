<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencySample;
use App\Service\Interfaces\IApiService;
use App\Service\Interfaces\ISampleService;
use App\Service\SeedService;

class ExchangeController extends Controller
{
    public function index(IApiService $apiService, SeedService $seedService)
    {
        $data = $apiService->callForToday();
        $data = $data['Valute'];
        $dto = $seedService->getDayRates($data);
        $out = $seedService->mapDtoToArray($dto);

        return $seedService->computeVibrations($out);
    }

    public function rates(CurrencySample $request, ISampleService $sampleService, SeedService $seedService)
    {
        $samplingRates = $request->data();
        $sample = $sampleService->sample($samplingRates);

        return $seedService->computeVibrations($sample);
    }
}
