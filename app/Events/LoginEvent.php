<?php

namespace App\Events;

use Illuminate\Http\Request;

class LoginEvent extends Event
{
    public $request;
    public $type;
    public $status;

    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @param AuditEnum $type
     * @param StatusEnum $status
     * 
     * @return void
     */
    public function __construct(Request $request, $type, $status)
    {
        $this->request = $request;
        $this->type = $type;
        $this->status = $status;
    }
}
