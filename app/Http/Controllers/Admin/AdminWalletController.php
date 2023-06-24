<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\WalletBalance;
use App\Models\Agent\WalletTransaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminWalletController extends Controller
{
    //

    public function __construct(WalletTransaction $wallet)
    {
        $this->middleware(['permission:wallet-list|wallet-create|wallet-edit|wallet-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:wallet-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:wallet-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:wallet-delete'], ['only' => ['destroy']]);
        $this->wallet = $wallet;
    }

    protected function getWallet($request)
    {
        $query = $this->wallet;
        if ($request->agent) {
            $agent = $request->agent;
            $query = $query->where('agentId', $agent);
        }
        return $query->orderBy('id', 'DESC');
    }
    protected function getAgent($ids){
        $agents = User::whereIn('id', $ids)->get();
        $agent_info = [];
        foreach ($agents as $key => $value) {
            $agent_info[$value->id] = $value->name['en'];
        }
        return $agent_info;
    }
    public function pendingWallet(Request $request)
    {
        $data = $this->getWallet($request)->where('status', 'pending');
        $ids = $data->pluck('agentId');
        $agent = $this->getAgent($ids);
        $title = 'Pending Wallet Transactions';
        $data = [
            'title' => $title,
            'agent' => $agent,
            'data' => $data->paginate(20),
        ];
        return view('admin/wallets/list', $data);
    }
    public function index(Request $request)
    {
        $data = $this->getWallet($request);
        $ids = $data->pluck('agentId');
        $agent = $this->getAgent($ids);
        $title = 'All Wallet Transactions';
        $data = [
            'title' => $title,
            'agent' => $agent,
            'data' => $data->paginate(20),
        ];
        return view('admin/wallets/list', $data);
    }

    public function create(Request $request)
    {
        $wallet_info = null;
        $title = 'Add Wallet';
        return view('admin/wallets/approve-wallet-balance', compact('wallet_info', 'title'));
    }
    public function show(Request $request, $id)
    {
        $wallet_info = $this->wallet->find($id);
        $agentInfo = $wallet_info->get_agent;
        abort_if(!$wallet_info, 404);
        $walletbalance = WalletBalance::where('agentId', $agentInfo->id)->first();
        if($walletbalance){
            $balance = $walletbalance->balance;
        }
        else{
            $balance = 0;
        }
        $title = 'Wallet Detail';
        return view('admin/wallets/view-transaction-detail', compact('wallet_info', 'title', 'balance'));
    }
    public function edit(Request $request, $id)
    {
        $wallet_info = $this->wallet->with(['get_agent'])->find($id);
        $agentInfo = $wallet_info->get_agent;
        if (!$wallet_info) {
            abort(404);
        }
        $walletbalance = WalletBalance::where('agentId', $agentInfo->id)->first();
        if($walletbalance){
            $balance = $walletbalance->balance;
        }
        else{
            $balance = 0;
        }
        // dd($wallet_info);
        $title = 'Update Wallet Balance';
        return view('admin/wallets/approve-wallet-balance', compact('wallet_info', 'agentInfo', 'title', 'balance'));
    }
    public function updateBalance(Request $request, $id)
    {
        // dd($request->all());
        Validator::make($request->all(), [
            'balance' => 'required|numeric|min:0',
            'updateBalance' => 'required|numeric|in:0,1',
        ])->validate();
        $wallet_info = $this->wallet->find($id);
        abort_if(!$wallet_info, 404);
        DB::beginTransaction();
        try {
            $walletbalance = WalletBalance::where('agentId', $wallet_info->get_agent->id)->first();
            if($walletbalance){
                $walletbalance->balance += $request->balance;
                $walletbalance->save();
            }
            else{
                WalletBalance::create([
                    'agentId' => $wallet_info->get_agent->id,
                    'balance' => $request->balance,
                ]);
            }
            $wallet_info->status = 'verified';
            $wallet_info->approved_amount = $request->balance;
            $wallet_info->verifiedBy = Auth::user()->id;
            $wallet_info->save();
            DB::commit();
            $request->session()->flash('success', 'Balance updated successfully.');
            return redirect()->route('wallets.index');
        } catch (Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    public function destroy(Request $request, $id)
    {
        $wallet_info = $this->wallet->find($id);
        if (!$wallet_info) {
            abort(404);
        }
        try {
            $wallet_info->delete();
            $request->session()->flash('success', 'Wallet Transaction deleted successfully.');
            return redirect()->route('wallet.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
}
