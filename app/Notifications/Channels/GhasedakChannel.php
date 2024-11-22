<?php

namespace App\Notifications\Channels;

use Exception;
use Illuminate\Notifications\Notification;
use Ghasedak\GhasedakApi;
use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;

class GhasedakChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toGhasedak'))
            throw new Exception('the method "toGhasedak" not found!');

        $data = $notification->toGhasedak($notifiable);
        $receptor = $notifiable->phone; // $notifiable = $user
        $code = $data['code'];
        $life_time = $data['life_time'];
        // $message = $data['message'];

        $api_key = config('services.ghasedak.key');
        $template = config('services.ghasedak.template');
        // $lineNumber = config('services.ghasedak.line_number');

        try {
            $api = new GhasedakApi($api_key); // change the key with your API key which you've got form your Ghasedak account

            // $api->SendSimple($receptor, $message, $lineNumber);

            $api->Verify(
                $receptor,  // receptor
                $template,  // name of the template which you've created in you account
                $code,       // parameters (supporting up to 10 parameters)
                $life_time,
            );

        } catch (ApiException $e) {
            throw $e;
        } catch (HttpException $e) {
            throw $e;
        }
    }
}
