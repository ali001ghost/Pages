<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;

    public function illnesses()
    {
        return $this->belongsTo(illness::class,);
    }

    public function users()
        {
            return $this->belongsToMany(User::class,'question_users','question_id');
        }
}
