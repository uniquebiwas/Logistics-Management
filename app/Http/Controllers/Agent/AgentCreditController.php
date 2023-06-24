<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentCreditBalance;
use App\Models\Credit;
use App\Models\ShipmentCharge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AgentCreditController extends Controller
{
    public function index(Request $request)
    {
        $credit_balance = AgentCreditBalance::where('agentId', Auth()->id())->first();
        return view('agent.Credit.index', compact('credit_balance'));
    }
    public function show(Request $request, $agentId)
    {
        $data = Credit::where('agentId', $agentId)->latest()
            ->when($request->startDate, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->startDate);
            })
            ->when($request->endDate, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->endDate);
            })
            ->when($request->agentId, function ($query) use ($request) {
                $query->where('agentId', $request->agentId);
            })
            ->paginate(15);
        return view('agent.Credit.history', compact('data'));
    }

    public function history()
    {
        $agentId = [auth()->id(), auth()->user()->parentId ?? 0];
        $history = ShipmentCharge::with('shipmentPackage:id,barcode')->whereIn('agentId', $agentId)->latest()->paginate(10);
        return view('agent.Credit.creditExpense', compact('history'));
    }


    public function changeDueDate(Request $request)
    {
        $data = Validator::make($request->all(), [
            'id' => 'required|exists:agent_credit_balances,id',
            'dueDate' => 'required',
        ])->validate();
        DB::beginTransaction();
        try {

            $agentCreditBalanace =  AgentCreditBalance::find($data['id']);
            Credit::create([
                'title' => 'Due Date Adjustment by ' .  auth()->user()->name['en'],
                'agentId' => $agentCreditBalanace->agentId,
                'dueDate' => $data['dueDate'],
                'createdBy' => auth()->id(),
                'creditAmount' => 0,
            ]);
            $agentCreditBalanace->update(['dueDate' => $data['dueDate']]);
            DB::commit();
            request()->session()->flash('success', 'Due Date changed successfully');
            return back();
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Due Date cannot be changed');
            DB::rollBack();
            return back();
        }
    }
}
