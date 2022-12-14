<?php

namespace App\Jobs;

use App\DTO\CurrencyRateDTO;
use App\Service\Create\CreateCurrencyRate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCurrencyRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(private CurrencyRateDTO $dto)
    {
    }


    public function handle()
    {
        app(CreateCurrencyRate::class)->run($this->dto);
    }
}
