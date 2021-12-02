<?php

namespace App\Listeners\UserActivation;

use App\Events\UserActivation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use \Kavenegar\Laravel\Facade as Kavenegar;
use Kavenegar\Laravel\ServiceProviderLaravel7;

//use Kavenegar\Laravel\ServiceProviderLaravel7; as Kaven

class SendSMSNotification
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserActivation  $event
     * @return void
     */
    public function handle(UserActivation $event)
    {
      // Smsirlaravel::ultraFastSend(['VerificationCode'=>$event->activationCode],41093,$event->user->phone);
    }
}
