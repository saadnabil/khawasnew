<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public function sender()
    {
        return $this->morphTo('sender');
    }

    public function reciever()
    {
        return $this->morphTo('reciever');
    }
}
