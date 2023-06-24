<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserDetailController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('users')
            ->select('users.name', 'countries.name as countryName', 'accountNumber', 'address', 'city', 'country', 'vatNumber', 'agent_profiles.company_name', 'agent_profiles.phone')
            ->leftJoin('agent_profiles', 'users.id', 'agent_profiles.userId')
            ->leftJoin('countries', 'countries.id', 'agent_profiles.country')
            ->where('users.id', $request->agentId)
            ->first();
        return response()->json(
            [
                'name' => $data->company_name ?? $data->name['en'],
                'accountNumber' => $data->accountNumber,
                'address' => $data->address . ' ,' . $data->city . ' ,' . $data->countryName,
                'vatNumber' => $data->vatNumber,
                'phone' => $data->phone
            ]
        );
    }
}
