<?php

namespace App\Listeners\StudentCompleteInfo;

use App\Events\StudentCompleteInfo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class SendSMSCompleteInfo
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
     * @param  StudentCompleteInfo  $event
     * @return void
     */
    public function handle(StudentCompleteInfo $event)
    {
        $fullname = $event->user->first_name . ' ' . $event->user->last_name;

        Smsirlaravel::ultraFastSend([
            'fullname'=>$fullname,
            'username'=>$event->user->usercode,
            'pass'=>$event->user->userpass,
            ],47663,$event->user->phone);
    }
}
