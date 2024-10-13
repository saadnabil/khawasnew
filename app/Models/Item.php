<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];

    protected $date = ['deleted_at'];

    public function setTitleAttribute($value)
    {
        if (!is_array($value)) {
            $value = ['en' => $value]; // Or any default language key
        }
        $this->attributes['title'] = json_encode(array_map('trim', $value));
    }

    public function wishlisted(){
        return $this->hasOne(Wislist::class)->where('user_id', auth()->user()->id);
    }

    public function type(){
        return $this->belongsTo(ItemType::class, 'item_type_id')->withTrashed();;
    }

    public function order()
{
    return $this->belongsTo(Order::class);
}

// Item.php
public function tax()
{
    return $this->hasOne(ItemTax::class, 'item_id');
}


public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }
    public function editor()
    {
        return $this->belongsTo(Admin::class, 'editor_id');
    }

    // Accessor to retrieve translated titles as an array
    public function getTitleAttribute($value)
    {
        return json_decode($value, true)?: '';
    }

    public function setDescriptionAttribute($value)
    {
        if (!is_array($value)) {
            $value = ['en' => $value]; // Or any default language key
        }
        $this->attributes['description'] = json_encode(array_map('trim', $value));
    }
    

    // Accessor to retrieve translated description as an array
    public function getDescriptionAttribute($value)
    {
        return json_decode($value, true)?: '';
    }

    public function setUnitAttribute($value)
    {
        if (!is_array($value)) {
            $value = ['en' => $value]; // Or any default language key
        }
        $this->attributes['unit'] = json_encode(array_map('trim', $value));
      }

    // Accessor to retrieve translated description as an array
    public function getUnitAttribute($value)
    {
        return json_decode($value, true)?: [];
    }








}
