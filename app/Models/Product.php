<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode(array_map('trim', $value));
    }

    // Accessor to retrieve translated titles as an array
    public function getTitleAttribute($value)
    {
        return json_decode($value, true) ?: [];
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = json_encode(array_map('trim', $value));
    }

    // Accessor to retrieve translated description as an array
    public function getDescriptionAttribute($value)
    {
        return json_decode($value, true) ?: [];
    }

    public function setUnitAttribute($value)
    {
        $this->attributes['unit'] = json_encode(array_map('trim', $value));
    }

    // Accessor to retrieve translated description as an array
    public function getUnitAttribute($value)
    {
        return json_decode($value, true) ?: [];
    }
}
