<?php

namespace App\Notifications;

use App\Devi;
use App\Suscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeviNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Devi $devi, Suscriber $suscriber)
    {
        $this->devi = $devi;
        $this->suscriber=$suscriber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
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
        return (new MailMessage)
            ->subject('Demande de devis')
            ->greeting('Bonjour Monsieur')
            ->line(' L\'utilisateur '.$this->suscriber->prenon.' vient de recevoir un devi.')
            ->action('Information du Devis', route('admin.command.show',$this->devi))
            ->line('Merci beaucoup!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
