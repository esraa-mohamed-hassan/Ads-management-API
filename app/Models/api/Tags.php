<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\api\Ads;

class Tags extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The ads that belong to the tag.
     */
    public function advs()
    {
        return $this->belongsToMany(Ads::class, 'adv_tags');
    }
}
