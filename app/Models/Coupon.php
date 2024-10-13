<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'valid_to' => 'datetime',
        'valid_from' => 'datetime',  // if you need this field to be cast as well
    ];

    public function couponusers(){
        return $this->hasMany(CouponUser::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_users', 'coupon_id', 'user_id');
    }

    
}
