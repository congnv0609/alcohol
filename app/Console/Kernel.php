<?php

namespace App\Console;

use App\Events\SmokerProcessed;
use App\Jobs\SendNotification;
use App\Jobs\UpdateSmokerInfo;
use App\Notifications\EmaPrompt;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DateTime;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('ema:schedule-get')->daily();
        // $schedule->command('ema:get-schedule');
        $data = Cache::get('alcohol:schedule');

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if ((empty($value["attempt_time"]) && $value["nth_popup"] == 0) || (empty($value["attempt_time"]) && $value["postponded_1"] > 0)) {
                    $time = date_format(new DateTime($value["popup_time"]), 'H:i');
                    $schedule->job(new SendNotification($value))->daily()->at($time);
                }
                if ((empty($value["attempt_time"]) && $value["postponded_1"] == null && $value["postponded_2"] == null && $value["nth_popup"] == 1) || (empty($value["attempt_time"]) && $value["postponded_2"] > 0)) {
                    $time1 = date_format(new DateTime($value["popup_time1"]), 'H:i');
                    $schedule->job(new SendNotification($value))->daily()->at($time1);
                }
                if ((empty($value["attempt_time"]) && $value["postponded_1"] == null && $value["postponded_2"] == null && $value["postponded_3"] == null && $value["nth_popup"] == 2) || (empty($value["attempt_time"]) && $value["postponded_3"] > 0)) {
                    $time2 = date_format(new DateTime($value["popup_time2"]), 'H:i');
                    $schedule->job(new SendNotification($value))->daily()->at($time2);
                }
            }
        }


        //run event

        // $schedule->command('smoker:update-info')->everyFiveMinutes();
        $schedule->command('alert-mail:send')->dailyAt('01:00');
        // $schedule->command('smokers:report')->everyFifteenMinutes();
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
