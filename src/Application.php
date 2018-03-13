<?php

namespace Curlyspoon\Framework;

use Curlyspoon\Framework\Console\Kernel as ConsoleKernel;
use Curlyspoon\Framework\Exceptions\Handler as ExceptionHandler;
use Curlyspoon\Framework\Http\Controllers\PageController;
use Curlyspoon\Framework\Providers\ConsoleServiceProvider;
use Curlyspoon\Framework\Providers\ElementServiceProvider;
use Curlyspoon\Framework\Providers\ViewServiceProvider;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Laravel\Lumen\Application as LumenApplication;

class Application extends LumenApplication
{
    public function __construct(?string $basePath = null)
    {
        try {
            (new Dotenv($basePath))->load();
        } catch (InvalidPathException $e) {
        }

        parent::__construct($basePath);

        $this->registerRouts();
        $this->registerKernels();

        $this->register(ViewServiceProvider::class);
        $this->register(ElementServiceProvider::class);
    }

    protected function registerRouts()
    {
        $this->router->get('[{page:[a-z-]+}]', [
            'uses' => PageController::class.'@getShow',
            'as' => 'name',
        ]);
    }

    protected function registerKernels()
    {
        $this->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
        $this->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
    }

    public function prepareForConsoleCommand($aliases = true)
    {
        $this->withFacades($aliases);

        $this->register(ConsoleServiceProvider::class);
    }
}
