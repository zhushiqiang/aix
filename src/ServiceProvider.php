<?php

namespace Xinchan\Aix;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(AccessToken::class, function(){
            return new AccessToken(config('services.aix.client_id'), config('services.aix.client_secret'));
        });

        $this->app->alias(AccessToken::class, 'accessToken');
        $this->app->alias(Company::class, 'company');
    }

    public function provides()
    {
        return [AccessToken::class, 'accessToken'];
    }
}