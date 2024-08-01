<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValidasiSelesaiNotification extends Notification
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Saluran notifikasi yang digunakan
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Berkas Tidak Valid')
            ->line('Status berkas Anda adalah tidak valid.')
            ->action('Lihat Detail', url('/'))
            ->line('Terima kasih!');
    }

    public function toArray($notifiable)
    {
        return [
            'nama_berkas' => $this->data['nama_berkas'],
            'status' => $this->data['status'],
            'title' => $this->data['title'],
            'message' => $this->data['message'],
        ];
    }
}