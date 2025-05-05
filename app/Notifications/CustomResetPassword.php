<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
            ->subject('Permintaan Reset Password')
            ->greeting('Halo!')
            ->line('Kami menerima permintaan reset password untuk akun Anda.')
            ->line('Silakan klik tombol di bawah untuk mereset password Anda. Tautan ini hanya berlaku selama **60 menit**.')
            ->action('Reset Password', route('auth.reset-password', ['token' => $this->token]))
            ->line('Jika Anda tidak meminta reset password, abaikan email ini. Akun Anda tetap aman.')
            ->salutation('Salam, **Tim Kasir Digital**');
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
