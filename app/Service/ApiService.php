<?php

namespace App\Service;

use App\Http\Controllers\API\ExchangeController;
use App\Service\Interfaces\IApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ApiService implements IApiService
{
    public const EXCHANGE_URL = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public const EXCHANGE_URL_FOR_DAY = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';

    public function callForToday()
    {
        $request = Http::get(self::EXCHANGE_URL)->body();
        $xml = simplexml_load_string($request);
        $json = json_encode($xml);

        return json_decode($json, TRUE);
    }

    public function callForDay(string $day)
    {
        $url = self::EXCHANGE_URL_FOR_DAY . $day;
        $request = Http::get($url)->body();
        $xml = simplexml_load_string($request);
        $json = json_encode($xml);

        return json_decode($json, TRUE);
    }

}
