<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AgentProfileController extends Controller
{
    //

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function agentProfile(Request $request)
    {

        $profile = $this->user->find($request->user()->id);
        $data = [
            'profile' => $profile,
            "title" => "Agent Profile"
        ];
        return view('agent.agent-profile', $data);
    }



    public function agentEditProfile(Request $request)
    {
        $profile = $this->user->find($request->user()->id);
        $data = [
            'profile' => $profile,
            "title" => "Update Profile"
        ];
        return view('agent.update-profile', $data);
    }


    public function updateAgentProfile(Request $request)
    {
        $profile = $this->user->find($request->user()->id);
        $profile->update([
            'name' => [
                'en' => $request->name,
                'np' => $request->name
            ],
            'currentAddress'=>$request->address
        ]);
        request()->session()->flash('success','profile updated successfully');
        return redirect()->back();
    }
}
