<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionUser extends Model
{
    use HasFactory;
    protected $fillable=['user_id','question_id','answer'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function questions()
    {
        return $this->belongsTo(question::class,'question_id');
    }
}
