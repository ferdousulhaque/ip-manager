<?php

namespace App\Http\Services;

use App\Enum\AuditEnum;
use App\Models\Audit;
use Illuminate\Http\Request;

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
     * @param Request $request
     */
    public function log(Request $request): void
    {
        $this->audit->change = json_encode(["changes" => 1]);
        $this->audit->type = AuditEnum::LOGIN_ACTIVITY;
        $this->audit->modify_by = auth()->user()->id;

        $this->audit->save();
    }
}
