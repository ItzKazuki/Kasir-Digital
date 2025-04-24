<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserStatusChangedNotification extends Notification
{
    use Queueable;

    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = $this->status === 'approved'
            ? 'Selamat! Akun Anda telah disetujui. Anda sekarang dapat mengakses dashboard.'
            : 'Maaf, akun Anda telah ditolak. Silakan hubungi admin untuk informasi lebih lanjut.';

        $mailMessage = (new MailMessage)
            ->subject('Perubahan Status Akun')
            ->greeting('Halo, ' . $notifiable->full_name)
            ->line($message);

        // Tambahkan tombol login jika statusnya approved
        if ($this->status === 'approved') {
            $mailMessage->action('Login Sekarang', route('auth.login'));
        }

        $mailMessage->line('Jika Anda mengalami kendala saat login, silakan hubungi tim dukungan kami.')
            ->salutation('Salam hangat, **Tim Kasir Digital**');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
