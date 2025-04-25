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
        switch ($this->status) {
            case 'approved':
                $message = 'Selamat! Akun Anda telah disetujui. Anda sekarang dapat mengakses dashboard.';
                break;
            case 'suspended':
                $message = 'Akun Anda telah ditangguhkan. Silakan hubungi tim dukungan untuk informasi lebih lanjut.';
                break;
            case 'pending':
                $message = 'Akun Anda sedang dalam proses verifikasi. Kami akan memberi tahu Anda setelah akun Anda disetujui.';
                break;
            case 'denied':
                $message = 'Akun Anda telah ditolak. Silakan hubungi tim dukungan untuk informasi lebih lanjut.';
                break;
            default:
                $message = 'Status akun Anda telah berubah. Silakan hubungi tim dukungan untuk informasi lebih lanjut.';
                break;
        }

        $mailMessage = (new MailMessage)
            ->subject('Perubahan Status Akun')
            ->greeting('Halo, ' . $notifiable->full_name)
            ->line($message);

        // Tambahkan tombol login jika statusnya approved
        if ($this->status === 'approved') {
            $mailMessage->action('Login Sekarang', route('auth.login'))
                ->line('Jika Anda mengalami kendala saat login, silakan hubungi tim dukungan kami.');
        }

        $mailMessage->salutation('Salam hangat, **Tim Kasir Digital**');

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
