<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
protected $fillable=['name','description','price','page_id','image','amount',];
protected $appends=['Newprice'];
    public function page()
    {
        return $this->belongsTo(page::class);
    }

    public function invite()
    {
        return $this->hasMany(invite::class);
    }

    public function getNewpriceAttribute()
{
    $currentTime = now();$discountedPrice = $this->price - ($this->price * $this->discount_percentage / 100);
    if ($this->start_date <= $currentTime && $currentTime <= $this->end_date) {

 return $discountedPrice;
    }
    return $discountedPrice;
}
}
