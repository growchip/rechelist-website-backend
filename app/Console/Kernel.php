<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('generate:slugs --offset=0 --limit=60')->everyMinute();
        $schedule->command('generate:slugs --offset=60 --limit=60')->everyTwoMinutes();
        $schedule->command('generate:slugs --offset=120 --limit=60')->everyThreeMinutes();
        $schedule->command('generate:slugs --offset=180 --limit=60')->everyFourMinutes();
        $schedule->command('generate:slugs --offset=240 --limit=60')->everyFiveMinutes();
        $schedule->command('generate:slugs --offset=300 --limit=60')->everyFiveMinutes();
        $schedule->command('generate:slugs --offset=360 --limit=60')->everyFiveMinutes();
        $schedule->command('generate:slugs --offset=420 --limit=60')->everyFiveMinutes();
        $schedule->command('generate:slugs --offset=416 --limit=60')->everyFiveMinutes();
// add more if needed

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
