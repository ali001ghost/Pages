<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pageUser extends Model
{
    protected $fillable=['user_id','page_id','isadmin','isblocked','end_date','start_date'];
    protected $dates = [
        'start_date',
        'end_date',
    ];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function page()
    {
        return $this->belongsTo(page::class, 'page_id');
    }
}
