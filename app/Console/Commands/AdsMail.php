<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\AdsMails;
use Illuminate\Support\Facades\Mail;

class AdsMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:adsmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ads Mail';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mail_data = [
            'title' => 'Mail from Ads Mangement',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('esraa.hassan147@gmail.com')->send(new AdsMails($mail_data));

        echo "Emailgg is sent successfully.";
        return 0;
    }
}
