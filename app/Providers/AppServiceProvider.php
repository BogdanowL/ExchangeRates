<?php

namespace App\Providers;

use App\Service\ApiService;
use App\Service\Interfaces\IApiService;
use App\Service\Interfaces\ISampleService;
use App\Service\Interfaces\ISeedService;
use App\Service\SampleSampleService;
use App\Service\SeedService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ISeedService::class, SeedService::class);
        $this->app->bind(IApiService::class, ApiService::class);
        $this->app->bind(ISampleService::class, SampleSampleService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
