<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValidasiSelesaiNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // Mengirim notifikasi ke database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Validasi telah selesai.',
            'link' => url('/'), // Tautan ke halaman atau rute yang sesuai
        ];
    }
}