<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationsComposer
{
    public function compose(View $view)
    {
       // Ambil user yang sedang login
$user = Auth::user();

// Ambil semua notifikasi untuk user
$notifications = $user ? $user->notifications : collect();

// Hitung jumlah notifikasi yang belum dibaca
$unreadNotificationsCount = $user ? $user->unreadNotifications()->count() : 0;

// Ambil nama user
$username = $user ? $user->name : null;

// Kirim data ke tampilan
$view->with([
    'notifications' => $notifications,
    'unreadNotificationsCount' => $unreadNotificationsCount,
    'username' => $username,
]);

    }
}