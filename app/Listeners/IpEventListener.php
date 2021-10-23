<?php

namespace App\Listeners;

use App\Events\IpEvent;
use App\Http\Services\AuditOperations;
use App\Models\Audit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IpEventListener
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
     * @param  \App\Events\IpEvent  $event
     * @return void
     */
    public function handle(IpEvent $event)
    {
        $action = new AuditOperations(new Audit);
        $action->log($event);
    }
}
