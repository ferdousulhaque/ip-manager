<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\AddIpsRequest;
use App\Http\Controllers\Requests\ModifyIpRequest;
use App\Http\Services\IpOperations;
use App\Models\Ip;
use Illuminate\Http\Request;

class IpsController extends Controller
{

    /**
     * List IPs
     * 
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            dd(Ip::all());

            //return successful response
            // return response()->json(['ip' => $add, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'IP Addition Failed!'], 409);
        }
    }

    /**
     * Add new IPs
     * 
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request)
    {

        //validate incoming request 
        $this->validate($request, AddIpsRequest::rules());

        try {
            $ipService = new IpOperations(new Ip);
            $add = $ipService->add($request);

            //return successful response
            return response()->json(['ip' => $add, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'IP Addition Failed!'], 409);
        }
    }

    /**
     * Update Ips Description
     * 
     * @param Request $request
     *
     * @return Response
     */
    public function modify(Request $request, $id)
    {

        //validate incoming request 
        $this->validate($request, ModifyIpRequest::rules());

        try {
            $ipService = new IpOperations(new Ip);
            $modify = $ipService->modify($request, $id);
            //return successful response
            return response()->json(['updated' => $modify, 'message' => $modify ? "Updated" : "Failed"], $modify ? 200 : 204);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'IP Update Failed!'], 409);
        }
    }
}
