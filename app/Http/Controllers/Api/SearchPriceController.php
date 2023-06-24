<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ZoneCountryServiceAgent;
use App\Traits\Shared\AdminSharedTrait;
use Illuminate\Http\Request;

class SearchPriceController extends Controller
{
    use AdminSharedTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchPrice(Request $request)
    {
        $data =  $this->validate(
            $request,
            [
                'receiver' => ['required', 'exists:countries,id'],
                'integrator' => ['required', 'exists:service_agents,id'],
                'weight' => ['required', 'numeric'],
                'agentId' => ['required', 'exists:users,id']
            ],
        );
        $zone = ZoneCountryServiceAgent::where('country_id', $request->receiver)
            ->where('serviceagent_id', $request->integrator)->latest()->first();
        if (!$zone) {
            return response()->json([
                'status' => false,
                'message' => ['Destination country doesnot belong to any zone for this integrator']
            ], 404);
        }
        return response()->json(
            [
                'price' =>  $this->getPrice($data['integrator'], $zone->zone_id, $data['weight'], $data['agentId']),
            ],
            200
        );
    }
}
