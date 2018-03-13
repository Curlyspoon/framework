<?php

namespace Curlyspoon\Framework\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use Curlyspoon\Framework\Console\Commands\ServeCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ServeCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
    }
}
