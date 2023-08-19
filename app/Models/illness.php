<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class illness extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(question::class,'illnesses_id');
    }

    public function media()
    {
        return $this->hasMany(media::class,'illnesses_id');
    }
}
