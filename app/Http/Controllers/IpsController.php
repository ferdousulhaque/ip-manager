<?php

namespace App\Http\Controllers;

use App\Enum\AuditEnum;
use App\Enum\StatusEnum;
use App\Events\IpEvent;
use App\Http\Requests\AddIpsRequest;
use App\Http\Requests\ModifyIpRequest;
use App\Http\Services\IpOperations;
use App\Models\Ip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class IpsController extends Controller
{
    private IpOperations $ipOperations;

    public function __construct(IpOperations $ipOperations)
    {
        $this->ipOperations = $ipOperations;
    }

    /**
     * List IPs for authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $ips = $this->ipOperations->list();
            
            return response()->json([
                'data' => $ips,
                'message' => 'IPs retrieved successfully',
                'count' => $ips->count()
            ], 200);
        } catch (\Exception $e) {
            Log::error('Failed to list IPs: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'exception' => $e
            ]);
            
            return response()->json([
                'message' => 'Failed to retrieve IPs'
            ], 500);
        }
    }

    /**
     * Add new IP
     *
     * @param AddIpsRequest $request
     * @return JsonResponse
     */
    public function add(AddIpsRequest $request): JsonResponse
    {
        try {
            $ip = $this->ipOperations->add($request);
            
            event(new IpEvent($request, AuditEnum::ADD_IP_ACTIVITY, StatusEnum::SUCCESS));
            
            return response()->json([
                'data' => $ip,
                'message' => 'IP added successfully'
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to add IP: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'request_data' => $request->validated(),
                'exception' => $e
            ]);
            
            event(new IpEvent($request, AuditEnum::ADD_IP_ACTIVITY, StatusEnum::FAIL));
            
            return response()->json([
                'message' => 'Failed to add IP address'
            ], 500);
        }
    }

    /**
     * Update IP description
     *
     * @param ModifyIpRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function modify(ModifyIpRequest $request, int $id): JsonResponse
    {
        try {
            $updated = $this->ipOperations->modify($request, $id);
            
            if ($updated) {
                event(new IpEvent($request, AuditEnum::MODIFY_IP_ACTIVITY, StatusEnum::SUCCESS));
                
                return response()->json([
                    'message' => 'IP updated successfully'
                ], 200);
            }
            
            return response()->json([
                'message' => 'Failed to update IP'
            ], 422);
        } catch (ModelNotFoundException $e) {
            Log::warning('IP not found for modification', [
                'user_id' => auth()->id(),
                'ip_id' => $id
            ]);
            
            return response()->json([
                'message' => 'IP not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Failed to modify IP: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'ip_id' => $id,
                'request_data' => $request->validated(),
                'exception' => $e
            ]);
            
            event(new IpEvent($request, AuditEnum::MODIFY_IP_ACTIVITY, StatusEnum::FAIL));
            
            return response()->json([
                'message' => 'Failed to update IP'
            ], 500);
        }
    }

    /**
     * Get single IP
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $ip = $this->ipOperations->one($id);
            
            return response()->json([
                'data' => $ip,
                'message' => 'IP retrieved successfully'
            ], 200);
        } catch (ModelNotFoundException $e) {
            Log::warning('IP not found', [
                'user_id' => auth()->id(),
                'ip_id' => $id
            ]);
            
            return response()->json([
                'message' => 'IP not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve IP: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'ip_id' => $id,
                'exception' => $e
            ]);
            
            return response()->json([
                'message' => 'Failed to retrieve IP'
            ], 500);
        }
    }

    /**
     * Delete IP
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            $deleted = $this->ipOperations->delete($id);
            
            if ($deleted) {
                event(new IpEvent($request, AuditEnum::DELETE_IP_ACTIVITY, StatusEnum::SUCCESS));
                
                return response()->json([
                    'message' => 'IP deleted successfully'
                ], 200);
            }
            
            return response()->json([
                'message' => 'Failed to delete IP'
            ], 422);
        } catch (ModelNotFoundException $e) {
            Log::warning('IP not found for deletion', [
                'user_id' => auth()->id(),
                'ip_id' => $id
            ]);
            
            return response()->json([
                'message' => 'IP not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Failed to delete IP: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'ip_id' => $id,
                'exception' => $e
            ]);
            
            event(new IpEvent($request, AuditEnum::DELETE_IP_ACTIVITY, StatusEnum::FAIL));
            
            return response()->json([
                'message' => 'Failed to delete IP'
            ], 500);
        }
    }
}
