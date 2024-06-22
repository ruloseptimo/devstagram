<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        $user->follower()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user)
    {
        $user->follower()->detach(auth()->user()->id);

        return back();
    }
}
