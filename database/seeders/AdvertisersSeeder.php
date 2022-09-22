<?php


namespace Database\Seeders;

use App\Models\api\Advertisers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class AdvertisersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $digits = 3;

        for ($i=0; $i < 10; $i++) {
	    	Advertisers::create([
	            'name' => Str::random(8),
	            'email' => 'advertiser_'. substr(str_shuffle("0123456789"), 0, 3).'@adsmail.com',
	        ]);
    	}
    }
}
