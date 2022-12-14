<?php

namespace App\Service\Update;

use App\Models\CurrencyDay;
use App\Service\Interfaces\ISeedService;

class UpdateCurrencyDay
{

    public function __construct(private ISeedService $seedService)
    {
    }

    public function run(CurrencyDay $currencyDay, array $dto)
    {
        $currencies = $this->seedService->sortNameCurrency($dto);

        foreach ($currencyDay->rates as $rate) {
            $currency = $currencies[$rate->char_code];

            $rate->value = $currency->value;
            $rate->save();
        }

        return $currencyDay;
    }


}
