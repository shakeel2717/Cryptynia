<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'amountf',
        'address',
        'dest_tag',
        'txn_id',
        'confirms_needed',
        'timeout',
        'from_currency',
        'to_currency',
        'status',
        'checkout_url',
        'status_url',
        'qrcode_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
