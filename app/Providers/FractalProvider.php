<?php

namespace App\Providers;

use App\Serializers\ArrayTransformerSerializer;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\ScopeFactory;

class FractalProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Manager::class, function () {
            $scopeFactory = new ScopeFactory();
            $manager      = new Manager($scopeFactory);
            $serializer   = new ArrayTransformerSerializer();

            $manager->setSerializer($serializer);

            return $manager;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
