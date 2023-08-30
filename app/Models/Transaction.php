<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'status',
        'sum',
        'reference',
        'user_plan_id',
        'withdraw_id',
        'reward_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function withdraw()
    {
        return $this->belongsTo(Withdraw::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
