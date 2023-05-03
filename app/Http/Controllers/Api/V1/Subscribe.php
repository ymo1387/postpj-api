<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Subscribe extends Controller
{
    public function subscribers(User $user)
    {
        return response()->json($user->subscribers->load('user:id,name')->pluck('user'));
    }

    public function subscribe(User $user)
    {
        $user->subscribers()->create(['subscriber_id' => auth()->user()->id]);

        return response()->noContent();
    }

    public function unsubscribe(User $user)
    {
        $user->subscribers()->where('subscriber_id', auth()->user()->id)->delete();

        return response()->noContent();
    }
}
