<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ResetColumnValueCommandWeekly::class,
        Commands\ResetColumnValueCommandQuartly::class,
        Commands\ResetColumnValueCommandMonthly::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->everyMinute()->appendOutputTo("scheduler-output.log");
        $schedule->command('reset:weekly')->weekly()->appendOutputTo("scheduler-output.log");
        $schedule->command('reset:quartly')->quarterly()->appendOutputTo("scheduler-output.log");
        $schedule->command('reset:monthly')->monthly()->appendOutputTo("scheduler-output.log");
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
