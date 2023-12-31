<?php

namespace App\Notifications;

use App\Models\Etudiant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RemarqueNotification extends Notification
{
    use Queueable;

    protected $remarque;
    protected $title;
    protected $tranche_id;
    protected array $from;
    protected array $etudiant;

    /**
     * Create a new notification instance.
     */
    public function __construct($remarque, $tranche_id, $etudiant, $from, $title)
    {
        $this->remarque = $remarque;
        $this->title = $title;
        $this->tranche_id = $tranche_id;
        $this->etudiant = $etudiant;
        $this->from = $from;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'remarque' => $this->remarque,
            'tranche_id' => $this->tranche_id,
            'from' => $this->from,
            'etudiant' => $this->etudiant,
        ];
    }
}
