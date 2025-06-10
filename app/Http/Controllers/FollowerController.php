<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function followUnfollow(User $user)
    {
        $authUser = Auth::user();
        $wasFollowing = $user->isFollowedBy($authUser);

        $user->followers()->toggle($authUser);


        if (!$wasFollowing && $user->id !== $authUser->id) {
            $user->notify(new UserFollowedNotification($authUser));
        }

        return response()->json([
            'followersCount' => $user->followers()->count(),
        ]);
    }
}
