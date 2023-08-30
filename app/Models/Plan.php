<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_price',
        'max_price',
        'min_profit',
        'max_profit',
        'status',
    ];

    public function plan_profit()
    {
        return $this->hasOne(PlanProfit::class);
    }
}
