<?php

namespace App\Notifications;

use App\Notifications\Channels\GhasedakChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActiveCodeNotification extends Notification
{
    use Queueable;

    public $code;

    /**
     * Create a new notification instance.
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable) : array
    {
        return [GhasedakChannel::class];
    }

    public function toGhasedak($notifiable) : array
    {
        return [
            // 'message' => "کد احراز هویت : $this->code \n اعتبار کد : " . env("SMS_CODE_LIFETIME") . " دقیقه \n سپاراتور صنعت علی محمدی"
            'code' => $this->code,
            'life_time' => env("SMS_CODE_LIFETIME")
        ];
    }
}
