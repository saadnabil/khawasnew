<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\RoutesNotifications;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable,HasRoles,RoutesNotifications,HasDatabaseNotifications;
    protected $guarded = [];
    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }
    public function editedItems()
    {
        return $this->hasMany(Item::class, 'editor_id');
    }

    public function getUsers(){
        return $this->hasMany(User::class);
    }
    public function sentMessages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function receivedMessages()
    {
        return $this->morphMany(Message::class, 'reciever');
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }


}
