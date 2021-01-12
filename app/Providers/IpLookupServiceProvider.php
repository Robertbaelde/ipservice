<?php

namespace App\Providers;

use App\Services\CachedIpInfoLookupService;
use App\Services\IpInfoLookupService;
use App\Services\IpLookupServiceInterface;
use Illuminate\Support\ServiceProvider;
use ipinfo\ipinfo\IPinfo;

class IpLookupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CachedIpInfoLookupService::class)
            ->needs(IpLookupServiceInterface::class)
            ->give(function () {
                return new IpInfoLookupService(new IPinfo(config('services.ip_info')));
            });

        $this->app->bind(IpLookupServiceInterface::class, CachedIpInfoLookupService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
