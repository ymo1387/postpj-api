<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function userList(Request $request)
    {
        $search = $request->query('s');
        $users = User::where('name','like','%'.$search.'%')
                ->whereNot(function (Builder $query) {
                    $query->where('id', auth()->user()->id);
                })->get();

        $subers = auth()->user()->subscribings()->pluck('user_id');
        return response()->json(['users' => $users, 'subers' => $subers]);
    }
}
