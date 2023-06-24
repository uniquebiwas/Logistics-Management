<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Admin\MembershipPackage;
use App\Models\Agent\WalletBalance;
use App\Models\Agent\WalletTransaction;
use App\Models\AgentMembershipHistory;
use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\LowBalanceNotification;

class MembershipPackageController extends Controller
{
    public function __construct(MembershipPackage $package)
    {
        $this->package = $package->where('publishStatus', 1);
    }
    protected function getPackage($request)
    {
        $query = $this->package;
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where(function ($qr) use ($keyword) {
                $qr->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query->orderBy('id', 'DESC')->paginate(6);
    }
    public function index(Request $request)
    {
        //
        $wallet = WalletBalance::where('agentId', Auth::user()->id)->first();
        // dd($wallet);
        if(!$wallet){
            $wallet_balance = 0;
        }
        else{
            $wallet_balance = $wallet->balance;
        }
        $packages = $this->getPackage($request);
        $data = [
            'title' => "Membership Packages",
            'wallet_balance' => $wallet_balance,
            'packages' => $packages
        ];
        return view('agent.membership.list', $data);
    }
    public function membershipHistory(Request $request)
    {
        $query = AgentMembershipHistory::where('agentId', Auth::user()->id);

        $boughtPackages = [];
        foreach ($query->get() as $key => $value) {
            $boughtPackages[$value->get_package->id] = $value->get_package->title['en'];
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('membershipPackageId', $keyword);
        }

        $agentPackageHistory = $query->orderBy('id', 'DESC')->paginate(10);
        $data = [
            'title' => "Membership Packages History",
            'data' => $agentPackageHistory,
            'boughtPackages' => $boughtPackages,
        ];
        return view('agent.membership.history.list', $data);
    }
    public function buyMembership($id)
    {
        try {
            DB::beginTransaction();
            $wallet = WalletBalance::where('agentId', Auth::user()->id)->first();
            if(!$wallet){
                $wallet_balance = 0;
            }
            else{
                $wallet_balance = $wallet->balance;
            }
            $package = $this->package->find($id);
            // $diff = $wallet->balance - $package->package_amount;
            if($wallet_balance < $package->package_amount){
                request()->session()->flash('error', 'Insufficient Funds.');
                return redirect()->route('wallet.create');
            }
            else{
                if($wallet->update(['balance' => $wallet_balance - $package->package_amount])){

                    $remaining_balance = $wallet_balance - $package->package_amount;
                    $setting = AppSetting::first();

                    // dd($setting->min_agent_balance);
                    if($remaining_balance < $setting->min_agent_balance){

                        $user = User::where('id',Auth::user()->id)->first();
                        $data = [
                            'body' => 'Your balance is getting low. The remaining balance is Rs '.$remaining_balance.'.',
                            'attention' => 'Load Now',
                            'url' => url('/agent/wallet/create'),
                            'thanks' => 'Thank you',

                        ];
                        $user->notify(new LowBalanceNotification($data));

                    }
                }

                AgentMembershipHistory::create([
                    'agentId' => Auth::user()->id,
                    'membershipPackageId' => $package->id,
                    'totalAmount' => $package->package_amount,
                    'totalRequest' => $package->yearly_max_request,
                    'remainingRequestCount' => $package->yearly_max_request,
                    'usedRequest' => '0',
                    'cancelledRequest' => '0',
                ]);
                DB::commit();
                request()->session()->flash('success', 'Membership Package : '. $package->title['en'] . 'bought successfully!');
                return redirect()->back();
            }
        } catch (\Exception $error) {
            DB::rollback();
            request()->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

}
