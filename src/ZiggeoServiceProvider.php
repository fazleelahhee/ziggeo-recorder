<?php

namespace ZiggeoRecorder;

include_once __DIR__."/ziggeo/ziggeophpsdk/Ziggeo.php";

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Ziggeo;

class ZiggeoServiceProvider extends ServiceProvider 
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot() 
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
        
        $this->app->singleton('Ziggeo', function ($app) {
            $ziggeo = null;
            if(empty(config('ziggeo.token')) || config('ziggeo.private_key')) {
                Log::error('Ziggeo key is missing');
            } else {
                $ziggeo = new Ziggeo(config('ziggeo.token'), 
                config('ziggeo.private_key'), 
                config('ziggeo.encryption_key'), 
                config('ziggeo.config'));
            }
            return $ziggeo;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() 
    {
        

    }

   /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../config/ziggeo.php' => config_path('ziggeo.php'),
        ], 'ziggeo-config');
    }
}