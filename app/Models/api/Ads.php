<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\api\Advertisers;
use App\Models\api\Categories;
use App\Models\api\Tags;

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
        return $this->belongsTo(Advertisers::class);
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
        return $this->hasMany(Categories::class);
    }
}
