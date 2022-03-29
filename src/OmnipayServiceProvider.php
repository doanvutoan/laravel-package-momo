<?php

namespace Dvt\Momo;

use Illuminate\Support\ServiceProvider;

class OmnipayServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('momo', function () {
            return new Momo();
        });
    }
}