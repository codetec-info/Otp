<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Bitfumes\KarixNotificationChannel\KarixChannel;
use Bitfumes\KarixNotificationChannel\KarixMessage;

class OTPNotification extends Notification
{
    use Queueable;

    public $via, $OTP;

    /**
     * Create a new notification instance.
     *
     * @param $via
     * @param $OTP
     */
    public function __construct($via, $OTP)
    {
        $this->via = $via;
        $this->OTP = $OTP;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->OTP == 'via_sms' ? [KarixChannel::class] : ['mail'];
    }

    public function toKarix($notifiable)
    {
        return KarixMessage::create()
                        ->from('+96170675298')
                        ->to('+96170675298')
                        ->content("Your OTP for login is {$this->OTP}");
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->markdown('OTP', ['OTP' => $this->OTP]);
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
