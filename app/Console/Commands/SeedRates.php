<?php

namespace App\Console\Commands;

use App\Jobs\CreateCurrencyRateJob;
use App\Service\Create\CreateCurrencyDay;
use App\Service\Create\CreateRatesForDay;
use App\Service\SeedService;
use Illuminate\Console\Command;

class SeedRates extends Command
{
    private const START_SEED_MESSAGE = '         Seeding into the database in the process';

    private const FINISH_SEED_MESSAGE = '        Seeding into the database is finished. The base is ready';

    protected $signature = 'seed:rates';

    protected $description = 'Get exchange rates for X days';

    public function handle(SeedService $seedService)
    {
        $start = microtime(true);
        $this->startMessage();

        $quantity = $this->ask('Укажите количество дней для посева в БД');
        $days = $seedService->getDays($quantity);
        $bar = $this->output->createProgressBar(count($days));
        $bar->start();

        foreach ($days as $day){
            app(CreateRatesForDay::class)->run($day);
        }

        $bar->finish();
        $this->finishMessage();
        $finish = microtime(true);

        $this->info("Time: " . (int)($finish - $start) . " seconds");

        return Command::SUCCESS;
    }
    private function startMessage() : void
    {
        $this->newLine();
        $this->info(self::START_SEED_MESSAGE);
        $this->newLine();
    }

    private function finishMessage() : void
    {
        $this->newLine();
        $this->newLine();
        $this->info(self::FINISH_SEED_MESSAGE);
        $this->newLine();
    }
}
