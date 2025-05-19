<?php

namespace App\Console\Commands;

use App\Mail\welcomemail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $to = "developer190026@gmail.com";
        $message ="welcome cronjob testing";
        $subject ="New Employee created";

        Mail::to($to)->queue(new welcomemail($message, $subject));
    }
}
