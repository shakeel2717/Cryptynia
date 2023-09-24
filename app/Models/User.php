<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'username',
        'email',
        'mobile',
        'country',
        'refer',
        'position',
        'status',
        'networker',
        'password',
        'left_user_in',
        'right_user_in',
        'binary_match',
        'token',
        'vip'
    ];

    public static function status()
    {
        return collect(
            [
                ['status' => 'pending',  'label' => 'Pending'],
                ['status' => 'active',  'label' => 'Active'],
                ['status' => 'suspend',  'label' => 'Suspend'],
            ]
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function pending_tids()
    {
        return $this->hasMany(Tid::class)->where('status', false);
    }

    public function kyc()
    {
        return $this->hasOne(Kyc::class);
    }

    public function userPlan()
    {
        return $this->hasOne(UserPlan::class)->where('status', 'active');
    }

    public function userPlansCount()
    {
        return $this->hasMany(UserPlan::class);
    }

    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }


    public function tids()
    {
        return $this->hasMany(Tid::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function exchange()
    {
        return $this->hasMany(Exchange::class);
    }

    public function CoinPayment()
    {
        return $this->hasMany(CoinPayment::class);
    }

    public function confirmOrders()
    {
        return $this->hasMany(Order::class, 'seller_id')->where('status', false);
    }

    public function directReferrals()
    {
        return $this->hasMany(User::class, 'refer', 'username');
    }

    public function indirectReferralsLevel1()
    {
        return $this->hasMany(User::class, 'refer', 'username')->with('directReferrals');
    }
}
