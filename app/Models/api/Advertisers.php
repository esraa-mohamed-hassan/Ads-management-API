<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\api\Ads;

class Advertisers extends Model
{
    use HasFactory;
    protected $table = 'advertisers';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
    ];

     /**
     * Get the ads associated with the Advertisers.
     */
    public function ads()
    {
        return $this->hasOne(Ads::class);
    }
}
