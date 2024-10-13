<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['remaining_days'];

    public function getRemainingDaysAttribute()
    {
        $endDate = Carbon::parse($this->end_date);
        return $endDate->diffInDays(Carbon::now());
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
