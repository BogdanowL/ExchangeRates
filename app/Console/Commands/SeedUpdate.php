<?php

namespace App\Console\Commands;

use App\Jobs\CreateCurrencyRateJob;
use App\Jobs\CreateRatesForDay;
use App\Models\CurrencyDay;
use App\Repository\CurrencyDayRepository;
use App\Service\Create\CreateCurrencyDay;
use App\Service\Interfaces\IApiService;
use App\Service\Interfaces\ISeedService;
use App\Service\Update\UpdateCurrencyDay;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SeedUpdate extends Command
{

    protected $signature = 'cron:update';

    protected $description = 'Update exchange rates for today';


    public function handle(CurrencyDayRepository $dayRepository,
                           ISeedService $seedService,
                           IApiService $apiService)
    {
        $today = Carbon::now()->format('d/m/Y');

        $dayRate = $dayRepository->findByDay($today);
        if (!$dayRate){
         app(CreateRatesForDay::class)->run($today);
         $this->info("Create Success");
            return Command::SUCCESS;
        }

        $data = $apiService->callForToday();
        $data = $data['Valute'];

        $dto = $seedService->getDayRates($data);

        app(UpdateCurrencyDay::class)->run($dayRate, $dto);

        $this->info("Update Success");

        return Command::SUCCESS;
    }
}
