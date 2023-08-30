<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    protected  $fillable = [
        'user_id',
        'plan_id',
        'status',
        'amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function network_cap_transactions()
    {
        return $this->hasMany(Transaction::class)->where('sum', true);
    }
}
