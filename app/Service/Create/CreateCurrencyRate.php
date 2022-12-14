<?php

namespace App\Service\Create;

use App\Models\CurrencyRate;
use Spatie\LaravelData\Data;

class CreateCurrencyRate
{

    public function run(Data $dto)
    {
        $currencyRate = app(CurrencyRate::class);
        $currencyRate->currency_day_id = $dto->currencyDayId;
        $currencyRate->currency_id = $dto->currencyId;
        $currencyRate->num_code = $dto->numCode;
        $currencyRate->char_code = $dto->charCode;
        $currencyRate->nominal = $dto->nominal;
        $currencyRate->name = $dto->name;
        $currencyRate->value = $dto->value;
        $currencyRate->save();

        return $currencyRate;
    }

}
