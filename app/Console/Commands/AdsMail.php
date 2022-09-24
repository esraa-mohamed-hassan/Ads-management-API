<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\AdsMails;
use App\Models\api\Ads;
use Carbon\Carbon;
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
        $date = Carbon::now()->addDay(1)->format('Y-m-d');

        $data = Ads::with('advertiser:id,name,email')
                   ->with('tags')->with('category:id,name')
                   ->where('start_date', $date)->get();

        $all_data = [];
        foreach ($data as $val) {
            $all_tags = [];
            $cat_name = $val->categoryName($val->category);
            $name = $val->advertiserName($val->advertiser);
            $email = $val->advertiserEmail($val->advertiser);
            foreach ($val->tags as $tag) {
                array_push($all_tags, $tag->name);
            }

            $mail_data = [
                'advertiser' => $name,
                'title' => 'Mail from Ads Mangemant',
                'ads_title' => $val->title,
                'ads_description' => $val->description,
                'ads_type' => $val->type,
                'ads_category' => $cat_name,
                'ads_tags' => $all_tags,
                'ads_start_date' => $val->start_date,
            ];
            array_push($all_data, $mail_data);
            print("Email is sent successfully." . $val->id);
        }
        Mail::to($email)->send(new AdsMails($all_data));
        return 0;
    }
}
