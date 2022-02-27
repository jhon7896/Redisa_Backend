<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DateTime;

class SuccessfulLogin
{
    public function __construct()
    {
        //
    }
    public function handle(Login $event)
    {
        $event->user->user_lastLogin = new DateTime;
        $event->user->save();
    }
}
