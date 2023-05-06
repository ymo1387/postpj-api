<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    public function subscribers(User $user)
    {
        return response()->json($user->subscribers()->orderBy('id', 'desc')->get()->load('from:id,name')->pluck('from'));
    }

    public function subscribe(User $user)
    {
        auth()->user()->subscribings()->create(['user_id' => $user->id]);

        return response()->noContent();
    }

    public function unsubscribe(User $user)
    {
        auth()->user()->subscribings()->where('user_id', $user->id)->delete();

        return response()->noContent();
    }

    public function subscribing(User $user)
    {
        return response()->json($user->subscribings()->orderBy('id', 'desc')->get()->load('to:id,name')->pluck('to'));
    }
}
