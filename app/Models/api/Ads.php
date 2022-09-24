<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\api\Advertisers;
use App\Models\api\Categories;
use App\Models\api\Tags;
use Illuminate\Support\Facades\DB;

class Ads extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'title',
        'description',
        'category',
        'advertiser',
        'start_date',
    ];

    /**
     * Get the advertiser that owns the ads.
     */
    public function advertiser()
    {
        return $this->belongsTo(Advertisers::class, 'advertiser');
    }

    /**
     * The tags that belong to the ads.
     */
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'adv_tags');
    }

      /**
     * Get the comments for the blog post.
     */
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category')->select(['name']);
    }

    public function categoryName($id)
    {
        return Categories::whereId($id)->first()->name;
    }

    public function advertiserName($id)
    {
        return Advertisers::whereId($id)->first()->name;
    }

    public function advertiserEmail($id)
    {
        return Advertisers::whereId($id)->first()->email;
    }

    public function getTagByAdsId($id)
    {
        $ads_tags = Ads::with('tags')->whereId($id)->first();
        $tags = $ads_tags->tags;
        $all_tags = [];
        foreach($tags as $tag){
            array_push($all_tags, $tag->name);
        }
        return $all_tags;
    }




}
