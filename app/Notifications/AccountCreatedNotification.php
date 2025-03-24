<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
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
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS', 'noreply@kasirdigital.com'), 'Kasir Digital')
            ->subject('Selamat, ' . $this->user->full_name . '! Akun Anda Berhasil Dibuat')
            ->greeting('Halo, ' . $this->user->full_name . ' 🎉')
            ->line('Akun Anda di **Kasir Digital** telah berhasil dibuat. Sekarang Anda dapat login dan mulai menggunakan aplikasi.')
            ->action('Login Sekarang', route('auth.login'))
            ->line('Jika Anda mengalami kendala saat login, silakan hubungi tim dukungan kami.')
            ->salutation('Salam hangat, **Tim Kasir Digital**');
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
