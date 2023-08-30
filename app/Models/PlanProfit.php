<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanProfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'profit',
        'direct_commission',
        'binary_commission',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
