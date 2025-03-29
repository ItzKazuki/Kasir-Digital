<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $member;

    /**
     * Create a new notification instance.
     */
    public function __construct($member)
    {
        $this->member = $member;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS', 'noreply@kasirdigital.com'), 'Kasir Digital')
            ->subject('Selamat Datang, ' . $this->member->full_name . '!')
            ->greeting('Halo, ' . $this->member->full_name . ' 🎉')
            ->line('Terima kasih telah bergabung dengan **Kasir Digital**. Kami senang menyambut Anda dalam komunitas kami!')
            ->line('Sebagai anggota baru, Anda mendapatkan **' . $this->member->point . ' poin reward** yang bisa digunakan untuk bertransaksi.')
            // ->action('Cek Poin & Profil Anda', url('/member/profile')) TODO: add url member to login, the next update for mobile device in #24
            ->line('Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi tim dukungan kami.')
            ->salutation('Salam hangat,
        **Tim Kasir Digital**');
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
