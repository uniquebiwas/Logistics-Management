<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceAgent;
use App\Models\ZoneCountryServiceAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IntegratorController extends Controller
{
    public function integrator()
    {
        $integrator = ServiceAgent::where('publishStatus', 1)
            ->select('id', 'title')
            ->limit(3)
            ->get();
        return response()->json([
            'status' => true,
            'request_status' => 'success',
            'statusCode' => 200,
            'data' => $integrator,
        ], 200);
    }

    public function pricing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'weight' => ['required', 'numeric', 'gt:0'],
            'integrator' => ['required', 'exists:service_agents,id'],
            'country' => ['required', 'exists:countries,iso_2'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => mapErrorMessage($validator),
            ], 404);
        }
        try {
            $zone = ZoneCountryServiceAgent::where('serviceagent_id', $request->integrator)
                ->join('countries', 'countries.id', 'zone_country_service_agents.country_id')
                ->where('countries.iso_2', $request->country)
                ->first();
            if (!$zone) {
                return response()->json([
                    'status' => false,
                    'message' => ['Destination country doesnot belong to any zone for this integrator']
                ], 404);
            }
            $price = $this->getPrice($request->integrator, $zone->zone_id, $request->weight);
            if (!$price) {
                return response()->json([
                    'status' => false,
                    'message' => ['Price could not be fetched, please contact to our customer service']
                ], 404);
            }
            return response()->json([
                'status' => true,
                'price' => $price,
                'weight' => $request->weight,
                'message' => ['Price fetched successfully']
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => [$e->getMessage()]
            ], 502);
        }
    }
    protected function getPrice(int $serviceAgentId, $zone_id, $weight)
    {
        $price = DB::table('pricings')
            ->where('pricings.agent_id', 2) //default alg agent
            ->select('weight_prices.price')
            ->where('serviceAgentId', $serviceAgentId)
            ->where('zone_id', $zone_id)
            ->where('weight_prices.weight', '>=', $weight)
            ->join('weight_prices', 'weight_prices.pricing_id', 'pricings.id')
            ->orderBy('weight_prices.weight', 'asc')
            ->first();
        return optional($price)->price;
    }
}
