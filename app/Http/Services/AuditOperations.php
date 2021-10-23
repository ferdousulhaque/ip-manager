<?php

namespace App\Http\Services;

use App\Events\Event;
use App\Models\Audit;

class AuditOperations
{
    private $audit;

    /**
     * @param Audit
     */
    public function __construct(Audit $audit)
    {
        $this->audit = $audit;
    }

    /**
     * Add Audit Logs
     *
     * @param Event $event
     */
    public function log(Event $event): void
    {
        $this->audit->change = json_encode($event->request->all());
        $this->audit->type = $event->type;
        $this->audit->status = $event->status;
        $this->audit->ip = $event->request->ip();
        $this->audit->modify_by = auth()->user()->id ?? 0;

        $this->audit->save();
    }
}
