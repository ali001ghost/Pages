<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class illness extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'question_count'];

    public function questions()
    {
        return $this->hasMany(question::class,'illnesses_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'user_illnesses','illnesses_id');
    }
    public function media()
    {
        return $this->hasMany(media::class,'illnesses_id');
    }
}
