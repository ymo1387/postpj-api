<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['subscriber_id', 'get_noti'];

    public function user()
    {
        return $this->belongsTo(User::class, 'subscriber_id');
    }
}
