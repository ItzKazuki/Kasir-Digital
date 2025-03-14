<?php

namespace App\Notifications;

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TransactionCreatedNotification extends Notification
{
    use Queueable;

    private $transaction;
    private $member;

    /**
     * Create a new notification instance.
     */
    public function __construct(Transaction $transaction, Member $member)
    {
        $this->transaction = $transaction;
        $this->member = $member;
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
            ->subject('Transaksi Berhasil Dibuat')
            ->line('Halo, ' . $this->member->full_name)
            ->line('Transaksi Anda telah berhasil dibuat.')
            ->line('Nomor Invoice: ' . $this->transaction->invoice_number)
            ->line('Total Belanja: ' . number_format($this->transaction->total))
            ->line('Poin yang Anda gunakan: ' . $this->transaction->point_usage)
            ->line('Poin Anda sekarang bertambah menjadi: ' . $this->member->point)
            ->action('Lihat Transaksi', route('struk.search', $this->transaction->invoice_number))
            ->line('Terima kasih telah menggunakan ' . config('app.name') . '!');
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