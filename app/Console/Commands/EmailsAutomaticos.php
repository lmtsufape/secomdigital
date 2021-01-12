<?php

namespace App\Console\Commands;

use App\Http\Controllers\ClippingController;
use Illuminate\Console\Command;
use Illuminate\Routing\Route;

class EmailsAutomaticos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Enviar:Emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar Emails do Clipping Automaticamente';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Route('clipping.enviarEmail');
    }
}
