<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\ApplyFirewallRules::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('logs:import')->everyMinute();

        $schedule->command('modsec:monitor')->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }


}
