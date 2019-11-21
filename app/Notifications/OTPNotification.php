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

    public $via, $otp;

    /**
     * Create a new notification instance.
     *
     * @param $via
     * @param $otp
     */
    public function __construct($via, $otp)
    {
        $this->via = $via;
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->via == 'via_sms' ? [KarixChannel::class] : ['mail'];
    }

    /**
     * @param $notifiable
     * @return KarixMessage
     */
    public function toKarix($notifiable)
    {
        return KarixMessage::create()
//                        ->from('+96170675298') // this will use 'routeNotificationForKarix' in User::model
                        ->to('+96170675298')
                        ->content("Your OTP for login is {$this->otp}");
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
                    ->markdown('OTP', ['OTP' => $this->otp]);
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
