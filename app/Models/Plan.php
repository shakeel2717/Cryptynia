<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'min_profit',
        'max_profit',
        'status',
        'withdrawals',
        'duration'
    ];

    public function plan_profit()
    {
        return $this->hasOne(PlanProfit::class);
    }
}
