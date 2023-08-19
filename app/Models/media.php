<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class media extends Model
{



    use HasFactory;



    protected $fillable=['book','vedio','advice','illnesses_id'];

    public function illnesses()
    {
        return $this->belongsTo(illness::class,);
    }

}
