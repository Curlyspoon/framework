<?php

namespace Curlyspoon\Framework\Providers;

use Laravel\Lumen\Console\ConsoleServiceProvider as LumenConsoleServiceProvider;

class ConsoleServiceProvider extends LumenConsoleServiceProvider
{
    protected $commands = [
        'ScheduleFinish' => 'Illuminate\Console\Scheduling\ScheduleFinishCommand',
        'ScheduleRun' => 'Illuminate\Console\Scheduling\ScheduleRunCommand',
    ];

    protected $devCommands = [];
}
