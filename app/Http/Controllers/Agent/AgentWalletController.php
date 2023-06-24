<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent\WalletBalance;
use App\Models\Agent\WalletTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentWalletController extends Controller
{

    public function __construct(WalletBalance $wallet, WalletTransaction $wallet_transaction)
    {
        $this->wallet = $wallet;
        $this->wallet_transaction = $wallet_transaction;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $balance = $this->wallet->where('agentId', auth()->id())->first();
        $transactions = $this->wallet_transaction->where('agentId', auth()->id())->orderBy('id', 'DESC')->paginate(20);
        $data = [
            "balance" => $balance,
            "transactions" => $transactions,
            'title' => "Wallet",
        ];
        return view('agent.wallet.wallet-transaction', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $balance = $this->wallet->where('agentId', $request->user()->id)->first();
        $data = [
            'balance' => $balance,
            'title' => "Load Fund",
            "url" => route('wallet.store')
        ];

        return view('agent.wallet.wallet-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function mapwalletData($request, $transactionInfo =null)
    {
        $data = $request->only('amount', 'transactionId', 'remarks', 'paymentGateway');
        if ($request->scanned_voucher) {
            $voucher = uploadFile($request->scanned_voucher, "agents/" . auth()->id() . "/voucher", false, $request->transactionId, false);
            if ($voucher) {
                $data['image'] = $voucher;
                if($transactionInfo){
                    $old_file = $transactionInfo->image  ;
                    if($old_file && !empty($old_file) && file_exists(public_path($old_file))){
                        unlink(public_path($old_file));
                    }

                }
            } else {
                abort(502, 'Scanned voucher upload error.');
            }
        }

        $data['agentId'] = auth()->id();

        $data['paymentMethod'] = "offline";
        $data['type'] = 'credited';
        $data['status'] = 'pending';
        $data['title'] = "Wallet fund load request created";
        // dd($data);
        $wallet = $this->wallet->getWallet();
        $data['walletId'] = $wallet->id;
        return $data;
    }
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'amount' => "required|numeric",
            "transactionId" => "required|string|min:1|max:100",
            "scanned_voucher" => "required|mimes:jpg,png,svg,pdf|max:5000",
            "remarks"   => "nullable|string|max:200",
            "paymentGateway" => "required|string|in:bank,esewa,khalti,imepay"
        ]);
        // dd($request->all());
        $user = auth()->user();

        DB::beginTransaction();
        try {
            $data = $this->mapwalletData($request);
            $this->wallet_transaction->create($data);
            DB::commit();
            $request->session()->flash('success', 'Fund load request added successfully. We will reivew your request soon.');
            return redirect()->route('wallet.index');
        } catch (Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $transactionInfo =  $this->wallet_transaction->find($id);
        if (!$transactionInfo) {
            request()->session()->flash('error', 'Invalid transaction request.');
            return redirect()->route('wallet.index');
        }
        if($transactionInfo->status == 'verified'){
            request()->session()->flash('error', 'You can not edit this transaction.');
            return redirect()->route('wallet.index');
        }
        $balance = $this->wallet->where('agentId', auth()->id())->first();
        $transactionInfo->image = asset($transactionInfo->image);
        $data = [
            'balance' => $balance,
            'transactionInfo' => $transactionInfo,
            'title' => "Update Load Fund",
            "url" => route('wallet.update', $transactionInfo->id)
        ];

        return view('agent.wallet.wallet-create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $transactionInfo =  $this->wallet_transaction->find($id);
        if (!$transactionInfo) {
            request()->session()->flash('error', 'Invalid transaction request.');
            return redirect()->route('wallet.index');
        }
        if($transactionInfo->status == 'verified'){
            request()->session()->flash('error', 'You can not update this transaction.');
            return redirect()->route('wallet.index');
        }


        $this->validate($request, [
            'amount' => "required|numeric",
            "transactionId" => "required|string|min:1|max:100",
            "scanned_voucher" => "nullable|mimes:jpg,png,svg,pdf|max:5000",
            "remarks"   => "nullable|string|max:200",
            "paymentGateway" => "required|string|in:bank,esewa,khalti,imepay"
        ]);


        DB::beginTransaction();
        try {
            $data = $this->mapwalletData($request, $transactionInfo);
            $transactionInfo->fill($data)->save();
            DB::commit();
            $request->session()->flash('success', 'Fund load request updated successfully. We will reivew your request soon.');
            return redirect()->route('wallet.index');
        } catch (Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $transactionInfo =  $this->wallet_transaction->find($id);
        if (!$transactionInfo) {
            request()->session()->flash('error', 'Invalid transaction request.');
            return redirect()->route('wallet.index');
        }
        if($transactionInfo->status == 'verified'){
            request()->session()->flash('error', 'You can not remove this transaction.');
            return redirect()->route('wallet.index');
        }
        try {
            $transactionInfo->delete();
            request()->session()->flash('success', 'Transaction removed successfully.');
            return redirect()->route('wallet.index');
        }catch(Exception $error){
            request()->session()->flash('error', $error->getMessage());
            return redirect()->route('wallet.index');
        }
    }
}
