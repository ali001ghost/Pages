<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invite extends Model
{
    protected $fillable=['reciver_id','sender_id','product_id','status','inviteprice','price'];
    use HasFactory;

    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}

public function receiver()
{
    return $this->belongsTo(User::class, 'reciver_id');
}
public function product()
{
    return $this->belongsTo(product::class, );
}
}
