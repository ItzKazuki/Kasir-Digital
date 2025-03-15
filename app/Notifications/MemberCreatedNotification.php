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
            ->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'), env('MAIL_FROM_NAME', 'Example'))
            ->subject('Selamat Datang Member Baru')
            ->line('Halo, ' . $this->member->full_name)
            ->line('Terima kasih telah berbelanja di Toko Kami. Selamat menjadi bagian dari komunitas kami.')
            ->line('Poin kamu sekarang adalah ' . $this->member->point . '.')
            ->line('Terima kasih telah bergabung dengan kami!');
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