<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Http\Services\AuditOperations;
use App\Models\Audit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener
{


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        $action = new AuditOperations(new Audit);
        $action->log($event);
    }
}
