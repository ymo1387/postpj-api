<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['user_id', 'subscriber_id', 'get_noti'];

    public function from()
    {
        return $this->belongsTo(User::class, 'subscriber_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
