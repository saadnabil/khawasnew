<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'valid_to' => 'datetime',
        'valid_from' => 'datetime',  // if you need this field to be cast as well
    ];
}
