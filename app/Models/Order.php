<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exchange_id',
        'amount_in_pkr',
        'status',
    ];


    function user()
    {
        return $this->belongsTo(User::class);
    }
}
