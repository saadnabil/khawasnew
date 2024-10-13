<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];
  // Define the relationship to the Country model
  public function country()
  {
      return $this->belongsTo(Country::class, 'country_id');
  }

  // Define the relationship to the City model
  public function city()
  {
      return $this->belongsTo(City::class, 'city_id');
  }

  // Define the relationship to the State model
  public function state()
  {
      return $this->belongsTo(Area::class, 'state_id');
  }
    protected $date = ['deleted_at'];
}
