<?php

namespace Curlyspoon\Framework\Console;

use Curlyspoon\Framework\Console\Commands\ServeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ServeCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
    }
}
