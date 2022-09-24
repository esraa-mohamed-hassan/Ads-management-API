<?php

namespace App\Http\Controllers\api;

use App\Models\api\Ads;
use App\Http\Requests\AdsStoreRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\api\Advertisers;
use App\Models\api\Categories;
use App\Models\api\Tags;
use Illuminate\Support\Facades\DB;

class AdsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdsStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsStoreRequest $request)
    {
        try {
            $validator = $request->validated();

            $ads = $request->all();
            $new_ads = Ads::create($ads);
            $tags = json_decode($request->input('tags'));
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    $data = [
                        'tags_id' => $tag,
                        'ads_id' => $new_ads['id']
                    ];
                    DB::table('adv_tags')->insert($data);
                }
            } else {
                $data = [
                    'tags_id' => $tags,
                    'ads_id' => $new_ads['id']
                ];
                DB::table('adv_tags')->insert($data);
            }


            $ads = Ads::with('advertiser:id,name,email')->with('tags')->with('category:id,name')
                ->whereId($new_ads['id'])->first();

            $all_tags = [];
            $cat_name = $ads->categoryName($ads->category);
            $advertiser_data = [
                'name' => $ads->advertiserName($ads->advertiser),
                'email' => $ads->advertiserEmail($ads->advertiser),
            ];
            foreach ($ads->tags as $tag) {
                array_push($all_tags, $tag->name);
            }

            $data = [
                'id' => $ads->id,
                'title' => $ads->title,
                'description' => $ads->description,
                'advertiser' => $advertiser_data,
                'category' => $cat_name,
                'start_date' => $ads->start_date,
                'type' => $ads->type,
                'tags' => $all_tags,
            ];
            return $this->sendResponse($data, 'Added new Ads successfully.');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adsByAdvertisers($email)
    {
        try {
            $adv_id = Advertisers::where('email', $email)->first()->id;
            $ads = Ads::with('advertiser:id,name,email')->with('tags')->with('category:id,name')
                ->where('advertiser', $adv_id)->get();

            $all_ads = [];
            foreach ($ads as $val) {
                $all_tags = [];
                $cat_name = $val->categoryName($val->category);
                $advertiser_data = [
                    'name' => $val->advertiserName($val->advertiser),
                    'email' => $val->advertiserEmail($val->advertiser),
                ];
                foreach ($val->tags as $tag) {
                    array_push($all_tags, $tag->name);
                }
                $data = [
                    'id' => $val->id,
                    'title' => $val->title,
                    'description' => $val->description,
                    'advertiser' => $advertiser_data,
                    'category' => $cat_name,
                    'start_date' => $val->start_date,
                    'type' => $val->type,
                    'tags' => $all_tags,
                ];
                array_push($all_ads, $data);
            }
            return $this->sendResponse($all_ads, 'All Ads By Advertisers with email:' . $email . '.');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adsFilterByTag($id)
    {
        try {
            $tag = Tags::with('ads')->whereId($id)->first();
            $tag_name = $tag->name;
            $all_ads = [];
            foreach ($tag->ads as $ad) {

                $cat_name = $ad->categoryName($ad->category);
                $advertiser_data = [
                    'name' => $ad->advertiserName($ad->advertiser),
                    'email' => $ad->advertiserEmail($ad->advertiser),
                ];
                $data = [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'description' => $ad->description,
                    'advertiser' => $advertiser_data,
                    'category' => $cat_name,
                    'start_date' => $ad->start_date,
                    'type' => $ad->type,
                    'tags' => $tag_name,
                ];
                array_push($all_ads, $data);
            }
            return $this->sendResponse($all_ads, 'All Ads Filtered by TagID:' . $id . '.');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adsFilterByCategory($id)
    {
        try {
            $ads = Ads::with('category')->where('category',$id)->get();
            $all_ads = [];
            foreach ($ads as $ad) {

                $cat_name = $ad->categoryName($ad->category);
                $tags_name = $ad->getTagByAdsId($ad->id);
                $advertiser_data = [
                    'name' => $ad->advertiserName($ad->advertiser),
                    'email' => $ad->advertiserEmail($ad->advertiser),
                ];
                $data = [
                    'id' => $ad->id,
                    'title' => $ad->title,
                    'description' => $ad->description,
                    'advertiser' => $advertiser_data,
                    'category' => $cat_name,
                    'start_date' => $ad->start_date,
                    'type' => $ad->type,
                    'tags' => $tags_name,
                ];
                array_push($all_ads, $data);
            }
            return $this->sendResponse($all_ads, 'All Ads Filtered by Category ID:' . $id . '.');
        } catch (\Exception $e) {
            return $this->sendError('error Exception:', $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\api\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\api\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdsStoreRequest  $request
     * @param  \App\Models\api\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(AdsStoreRequest $request, Ads $ads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\api\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ads)
    {
        //
    }
}
