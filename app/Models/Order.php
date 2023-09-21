<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'exchange_id',
        'amount',
        'amount_in_pkr',
        'status',
    ];


    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exchange(){
        return $this->belongsTo(Exchange::class);
    }
}
