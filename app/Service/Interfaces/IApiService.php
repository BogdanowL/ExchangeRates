<?php

namespace App\Service\Interfaces;

interface IApiService
{
    public function callForToday();


    public function callForDay(string $day);

}
