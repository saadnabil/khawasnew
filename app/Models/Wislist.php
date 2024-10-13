<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wislist extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function addresses()
{
    return $this->hasMany(Address::class);
}


}
