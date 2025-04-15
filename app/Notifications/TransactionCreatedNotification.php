<?php

namespace App\Notifications;

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TransactionCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $transaction;
    private $member;
    private $additionalPoint;

    /**
     * Create a new notification instance.
     */
    public function __construct(Transaction $transaction, Member $member, int $additionalPoint)
    {
        $this->additionalPoint = $additionalPoint;
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
        $mailMessage = (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS', 'noreply@kasirdigital.com'), 'Kasir Digital')
            ->subject('Transaksi Berhasil - Invoice #' . $this->transaction->invoice_number)
            ->greeting('Halo, ' . $this->member->full_name . '!')
            ->line('Transaksi Anda telah berhasil dibuat.')
            ->line('**Nomor Invoice:** ' . $this->transaction->invoice_number)
            ->line('**Total Belanja:** Rp ' . number_format($this->transaction->total_price, 0, ',', '.'));

        // Hanya tampilkan poin yang digunakan jika tidak 0
        if ($this->transaction->point_usage > 0) {
            $mailMessage->line('**Poin yang Anda gunakan:** ' . number_format($this->transaction->point_usage, 0, ',', '.'));
        }

        $mailMessage->line('**Poin bertambah:** ' . number_format($this->additionalPoint, 0, ',', '.'))
        ->line('**Total poin Anda sekarang:** ' . number_format($this->member->point, 0, ',', '.'))
            ->action('Lihat Detail Transaksi', route('struk.search', $this->transaction->invoice_number))
            ->line('Terima kasih telah menggunakan **Kasir Digital**!')
            ->salutation('Salam, **Tim Kasir Digital**');

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
