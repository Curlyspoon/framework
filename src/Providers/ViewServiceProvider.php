<?php

namespace Curlyspoon\Framework\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->configure('view');

        $this->loadViewsFrom(realpath(__DIR__.'/../../views'), 'curlyspoon');
    }
}
