<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\ShipmentPackage;
use App\Models\ShipmentLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function bulkShipmentSchedule(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'mwab' => 'nullable',
            'airlines' => 'required',
            'flightNumber' => 'required',
            'scheduled_for' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                "status_code" => 422,
                "message" => mapErrorMessage($validation),
            ], 422);
        }
        $data = $validation->validated();
        DB::beginTransaction();
        try {
            ShipmentPackage::whereIn('id', $request->ids)->update([
                'airlines' => $data['airlines'],
                'package_status' => 'SCHEDULED',
                'scheduled_by' => auth()->id(),
                'scheduled_at' => $data['scheduled_for'],
                'statusId' => 5,
                'mwab' => $data['mwab'],
            ]);
            foreach ($request->ids as $value) {
               $this->generateLocation($value,'SCHEDULED');
            }
            DB::commit();
            return response()->json([
                'status' => false,
                "status_code" => 200,
                "message" => ['Package has been schedule successfully']
            ], 202);
        } catch (\Exception $error) {
            DB::rollback();
            return response()->json([
                "status" => false,
                "status_code" => 502,
                'message' => [$error->getMessage()],
            ], 502);
        }
    }

    public function generateLocation($id, $status)
    {
        return   ShipmentLocation::create(
            [
                'shipmentId' => $id,
                'countryId' => '148',
                'location' => 'Kathmandu',
                'package_status' => $status,
                'statusId' => '1',
            ]
        );
    }
}
