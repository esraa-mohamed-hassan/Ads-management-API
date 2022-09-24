<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsAds extends Model
{
    use HasFactory;

    protected $table = 'adv_tags';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tags_id',
        'ads_id',
    ];
}
