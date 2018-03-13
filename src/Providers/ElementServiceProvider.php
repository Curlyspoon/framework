<?php

namespace Curlyspoon\Framework\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\OptionsResolver\Options;
use Curlyspoon\Framework\Managers\ElementManager;
use Curlyspoon\Framework\Managers\NormalizerManager;
use Curlyspoon\Framework\Contracts\ElementManager as ElementManagerContract;
use Curlyspoon\Framework\Contracts\NormalizerManager as NormalizerManagerContract;

class ElementServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ElementManagerContract::class, function ($app) {
            return new ElementManager();
        });
        $this->app->singleton(NormalizerManagerContract::class, function ($app) {
            return new NormalizerManager();
        });

        $this->registerNormalizers();
    }

    protected function registerNormalizers()
    {
        $this->app->make(NormalizerManagerContract::class)
            ->register('url', function (Options $options, $value) {
                return url($value);
            });
    }
}
