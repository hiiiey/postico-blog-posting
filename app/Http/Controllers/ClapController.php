<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostLikedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClapController extends Controller
{
    /**
     * Toggle clap for a post
     * 
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function clap(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $hasClapped = $user->hasClapped($post);

        if ($hasClapped) {
            $post->claps()->where('user_id', $user->id)->delete();
        } else {
            $post->claps()->create([
                'user_id' => $user->id,
            ]);

            // Send notification to post author if they're not the same as the clapper
            if ($post->user_id !== $user->id) {
                $post->user->notify(new PostLikedNotification($user, $post));
            }
        }

        return response()->json([
            'clapsCount' => $post->claps()->count(),
        ]);
    }
}
