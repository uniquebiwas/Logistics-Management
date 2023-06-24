<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\ConsumedOtp;
use App\Models\AgentCreditBalance;
use App\Models\Agent\ShipmentPackage;
use App\Models\Agent\WalletBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AgentDashboardController extends Controller
{
    public function agent(Request $request)
    {
        // $wallet = WalletBalance::where('agentId',Auth::user()->id)->first();
        $wallet = AgentCreditBalance::where('agentId',Auth::user()->id)->first();
        $balance = $wallet->balance ?? 0;
        $package = ShipmentPackage::where('agentId',Auth::user()->id)->count();
        $data =  [
            'title' => "Agency Dashboard",
            'balance' => $balance,
            'package' => $package,
        ];
        return view('agent.dashboard', $data);
    }

    public function sendVerificationEmail(Request $request)
    {
        // try {
            DB::beginTransaction();
            $token = \Str::random(41);
            $user = Auth::user();
            $verification_data = [
                'userId'            => $user->id,
                'token'             => $token,
                "mobile"            => $request->mobile,
                'purpose'           => "re-verification"
            ];

            $verification_info = ConsumedOtp::create($verification_data);
            $appsetting = AppSetting::first();
            $verification_url = route('agent.verifyUser', $token);
            $maildata = [
                'email'             => $user->email,
                'fullname'              => $user->name['en'],
                'verification_url'  => $verification_url,
                'appsettings_name'  => $appsetting->name,
                'appsettings_logo'  => $appsetting->logo_url,
            ];
            Mail::send('mail/activation-email', $maildata, function ($message) use ($maildata) {
                $message->to($maildata['email'], $maildata['fullname'])
                    ->subject('Activation Email');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            DB::commit();
            $request->session()->flash('success', "An verification email has been resent to your email.");
            return redirect()->back();
        // } catch (\Exception $e) {
        //     DB::rollback();

        //     $request->session()->flash('error', $e->getMessage());
        //     return redirect()->back();
        // }
    }
    public function verifyUser(Request $request, $token)
    {
        // dd($token);
        $user = Auth::user();
        $verification = ConsumedOtp::where('token',$token)->where('userId',$user->id)->first();
        // dd($verification);
        if($verification){
            $data['emailVerifiedAt'] = now()->format('Y-m-d H:m:i');
            $user->fill($data)->save();
            $request->session()->flash('success', "An email has been verified successfully.");
            return redirect()->route('dashboard.index');
        }
        if(!$verification){
            $request->session()->flash('failure', "An email  could not be verified.");
            return redirect()->route('dashboard.index');
        }
    }
}
