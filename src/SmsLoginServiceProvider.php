<?php

namespace Satyam147\Smslogin;

use Illuminate\Support\ServiceProvider;

class SmsLoginServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/smslogin.php',
            'smslogin'
        );
        $this->publishes([
            __DIR__ . '/config/smslogin.php' => \config_path('smslogin.php')
        ]);
    }

    public function register()
    {

    }
}
