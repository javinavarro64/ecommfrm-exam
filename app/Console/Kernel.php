<?php

namespace App\Console;

use App\Notifications\Presentation\Console\SendNotificationCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendNotificationCommand::class
    ];
}
