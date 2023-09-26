<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagetype extends Model
{
    use HasFactory;
    public function page()
    {
        return $this->hasMany(page::class);
    }
}
