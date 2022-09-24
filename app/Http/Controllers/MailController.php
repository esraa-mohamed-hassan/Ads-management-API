<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AdsMails;
use App\Models\api\Ads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $date = Carbon::now()->addDay(1)->format('Y-m-d');;
        $data = Ads::with('advertiser:id,name,email')
                   ->with('tags')->with('category:id,name')
                   ->where('start_date', $date)->get();

        foreach ($data as $val) {
            $all_tags = [];
            $cat_name = $val->categoryName($val->category);
            $name = $val->advertiserName($val->advertiser);
            $email = $val->advertiserEmail($val->advertiser);
            foreach ($val->tags as $tag) {
                array_push($all_tags, $tag->name);
            }
            $data = [

            ];

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

            Mail::to($email)->send(new AdsMails($mail_data));
            print("Email is sent successfully." . $val->id);
        }
    }
}
