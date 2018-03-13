<?php

namespace Curlyspoon\Framework\Providers;

use Curlyspoon\Framework\Contracts\ElementManager as ElementManagerContract;
use Curlyspoon\Framework\Contracts\NormalizerManager as NormalizerManagerContract;
use Curlyspoon\Framework\Elements\MarkdownElement;
use Curlyspoon\Framework\Elements\RowElement;
use Curlyspoon\Framework\Elements\SectionBlurImageElement;
use Curlyspoon\Framework\Elements\SectionElement;
use Curlyspoon\Framework\Elements\SectionTextColumnsElement;
use Curlyspoon\Framework\Elements\TitleElement;
use Curlyspoon\Framework\Managers\ElementManager;
use Curlyspoon\Framework\Managers\NormalizerManager;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\OptionsResolver\Options;

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
