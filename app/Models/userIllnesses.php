<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userIllnesses extends Model
{
    use HasFactory;

protected $fillable=['user_id','illnesses_id','percentage'];

    public function illnesses()
    {
        return $this->belongsTo(illness::class,'illnesses_id');
    }


    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
