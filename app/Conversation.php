<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Conversation extends Model
{
    //
    protected $appends = ['contact_name'];
    public function getContactNameAttribute()
    {
        //return $this->contact->name;
        return $this->contact()->first(['name'])->name;

    }
    public function contact(){
        // conversacion  muchos  . uno  user
        return $this->belongsTo(User::class);
    }
}
