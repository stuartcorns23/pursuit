<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\NotifyAvailableOperatives;
use App\Jobs\AlertOperativesAvailability;
use App\Jobs\AlertOperativesTimesheet;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new NotifyAvailableOperatives)->weekly()->fridays()->at('11:00');
        $schedule->job(new AlertOperativesAvailability)->weekly()->thursdays()->at('11:00')->timezone('Europe/London');
        $schedule->job(new AlertOperativesTimesheet)->weekly()->mondays()->at('11:00')->timezone('Europe/London');
        //$schedule->job(new NotifyDailyShifts)->daily()->at('11:00');
        //$schedule->job(new NotifyAvailableOperatives)->everyFiveMinutes();
        //$schedule->job(new AlertOperativesAvailability)->everyFiveMinutes();
        //$schedule->job(new AlertOperativesTimesheet)->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
