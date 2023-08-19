<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class opinion extends Model
{
    use HasFactory;

protected $fillable=['opinion','user_id','status'];


    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
