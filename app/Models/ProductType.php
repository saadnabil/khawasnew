<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode(array_map('trim', $value));
    }

    // Accessor to retrieve translated description as an array
    public function getTitleAttribute($value)
    {
        return json_decode($value, true)?: [];
    }
}
