<?php

namespace App\Http\Services;

use App\Models\Ip;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class IpOperations
{
    private Ip $ip;

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
     * @throws \Exception
     */
    public function add(Request $request): Ip
    {
        $ip = new Ip();
        $ip->ip = $request->input('ip');
        $ip->desc = $request->input('desc');
        $ip->parent_id = auth()->user()->id;

        if (!$ip->save()) {
            throw new \Exception('Failed to save IP address');
        }

        return $ip->fresh();
    }

    /**
     * Modify Description
     *
     * @param Request $request
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function modify(Request $request, int $id): bool
    {
        $ip = $this->ip->where('parent_id', auth()->user()->id)
                       ->findOrFail($id);
        
        $ip->desc = $request->input('desc');
        
        return $ip->save();
    }

    /**
     * List Owned IPs
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->ip->where('parent_id', auth()->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
    }

    /**
     * Get Single IP
     *
     * @param int $id
     * @return Ip|null
     * @throws ModelNotFoundException
     */
    public function one(int $id): ?Ip
    {
        return $this->ip->where('parent_id', auth()->user()->id)
                        ->findOrFail($id);
    }

    /**
     * Delete IP
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool
    {
        $ip = $this->ip->where('parent_id', auth()->user()->id)
                       ->findOrFail($id);
        
        return $ip->delete();
    }
}
