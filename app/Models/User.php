<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\RoutesNotifications;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes,HasRoles,RoutesNotifications,HasDatabaseNotifications;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    // protected $date = ['deleted_at'];

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

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_users', 'user_id', 'coupon_id');
    }
    
    public function wishlists()
    {
        return $this->hasMany(Wislist::class);
    }

    public function addcoupons(){
        return $this->belongsToMany(CouponUser::class );
    }


    public function appliedcoupon(){
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }


  

    
    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'reciever');
    }

    public function tickets(){
        return $this->hasMany(Ticket::class, 'user_id');
    }


}
