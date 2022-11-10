<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\CallApi::class,
        Commands\NewsDelete::class,
   ];

   protected function schedule(Schedule $schedule)
   {
       $schedule->command('call:api')->everyMinute();
       $schedule->command('news:delete')->everyMinute();
   }

   protected function commands()
   {
       $this->load(__DIR__.'/Commands');

       require base_path('routes/console.php');
   }
}
