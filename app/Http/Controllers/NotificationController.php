<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function clearNotifications()
    {
        Auth::user()->notifications()->delete();

        return redirect()->back()->with('success', 'All notifications cleared.');
    }
}
