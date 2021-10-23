<?php

namespace App\Http\Services;

use App\Models\Ip;
use Illuminate\Http\Request;

class IpOperations
{
    private $ip;

    /**
     * @param Ip
     */
    public function __construct(Ip $ip)
    {
        $this->ip = $ip;
    }

    /**
     * Add IP
     *
     * @param Request $request
     * @return Ip
     */
    public function add(Request $request)
    {
        $this->ip->ip = $request->input('ip');
        $this->ip->desc = $request->input('desc');
        $this->ip->parent_id = auth()->user()->id;

        $this->ip->save();
        return $this->ip;
    }

    /**
     * Modify Description
     *
     * @param Request $request
     * @param int $id
     * @return Ip
     */
    public function modify(Request $request, int $id)
    {
        $ip = $this->ip->find($id);
        $ip->desc = $request->input('desc');

        return $ip->save();
    }

    /**
     * List Owned Ips
     *
     * @return Ip
     */
    public function list()
    {
    }
}
