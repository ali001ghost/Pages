<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    protected $fillable=['name','user_id','image','description','pagetype_id'];
    use HasFactory;


    public function product()
    {
        return $this->hasMany(product::class);
    }
    public function pagetype()
    {
        return $this->belongsTo(pagetype::class,);
    }
}
