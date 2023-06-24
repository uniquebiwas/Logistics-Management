<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchAgentController extends Controller
{
    public function getAgent(Request $request)
    {
        $user =  User::select('accountNumber', 'name', 'id')
            ->with('agent_profile:company_name,userId,id')
            ->find($request->userId);
        try {
            return response()->json([
                'senderName' => $user->name['en'],
                'accountNumber' => $user->accountNumber,
                'agentId' => $user->id,
                'billing_account' => $user->agent_profile->company_name,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'user not found',
            ], 404);
        }
    }
}
