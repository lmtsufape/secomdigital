<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ImageController;

class CartoesAutomaticos extends Command
{
    protected $signature = 'cartoesAutomaticos:cron';
    protected $description = 'Envia cartões de aniversário automaticamente';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new ImageController();
        $controller->envioAutomaticoCartao();
    }
}
