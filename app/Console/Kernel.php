<?php

namespace App\Console;

use App\Console\Commands\EmailsAutomaticos;
use App\Console\Commands\CartoesAutomaticos;
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
        //$schedule->call('App\Http\Controllers\ClippingController@gerarEmail')->timezone('America/Sao_Paulo')->everyMinute();
        $schedule->call('App\Http\Controllers\ImageController@envioAutomaticoCartao')->timezone('America/Sao_Paulo')->dailyAt('06:00');
        //$schedule->call('App\Http\Controllers\ImageController@envioAutomaticoCartao')->timezone('America/Sao_Paulo')->everyMinute();
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
