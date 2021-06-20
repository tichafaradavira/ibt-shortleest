<?php

namespace Modules\Applications\Listeners;

use Modules\Applications\Notifications\ApplicationSubmitted;

class HandleSubmittedApplication
{
    public function handle(\Modules\Applications\Events\ApplicationSubmitted $event)
    {
         $event->application->realtor->notify(new ApplicationSubmitted());;
    }
}
