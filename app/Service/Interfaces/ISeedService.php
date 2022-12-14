<?php

namespace App\Service\Interfaces;

interface ISeedService
{
    public const COUNT_CURRENCIES = 34;

    public function getRates(string $day);

}
