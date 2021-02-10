<?php

namespace AxlMedia\OddstakeSdk;

use Illuminate\Support\ServiceProvider;

class OddstakeSdkServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindFacade();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bind the Laravel facade to the Oddstake class.
     *
     * @return void
     */
    protected function bindFacade(): void
    {
        $this->app->bind('oddstake', function () {
            return new Oddstake;
        });
    }
}
