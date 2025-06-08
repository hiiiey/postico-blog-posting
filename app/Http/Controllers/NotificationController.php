<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications;

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $user->unreadNotifications->count()
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $notification = DatabaseNotification::findOrFail($id);

        // Check if the notification belongs to the authenticated user
        if (
            $notification->notifiable_id === Auth::id() &&
            $notification->notifiable_type === get_class(Auth::user())
        ) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true]);
    }
}
