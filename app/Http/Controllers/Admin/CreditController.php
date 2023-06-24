<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditRequest;
use App\Models\Agent\AgentProfile;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\User;
use App\Models\AgentCreditBalance;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = AgentCreditBalance::with('agent.agent_profile')
            ->latest()
            ->addSelect([
                'last_extended_date' => Credit::select('created_at')
                    ->whereColumn('credits.agentId', 'agent_credit_balances.agentId')
                    ->orderByDesc('created_at')
                    ->limit(1)
            ])
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
        $agentList = $this->getAgent();
        return view('admin.credit.index', compact('data', 'agentList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $credit = new Credit();
        $agent = $this->getAgent();
        $type = 'credit';
        return view('admin.credit.form', compact('credit', 'agent', 'type'));
    }
    public function createAdvance()
    {
        $credit = new Credit();
        $agent = $this->getAgent();
        $type = 'advance';
        return view('admin.credit.form', compact('credit', 'agent', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreditRequest $request)
    {
        $data = $request->validated();
        $data['createdBy'] = auth()->id();
        try {
            if (!isset($data['dueDate'])) {
                $data['dueDate'] = now()->addDays(30);
            }
            Credit::create($data);
            $creditbalance = AgentCreditBalance::where('agentId', $data['agentId'])->first();
            if ($creditbalance) {
                // dd($creditbalance->dueDate);
                $balance = $creditbalance->balance ?? 0;
                $creditAmount = $balance + $data['creditAmount'];
                if ($request->type == 'advance') {
                    $credit_data = [
                        'agentId' => $data['agentId'],
                        'balance' => $creditAmount,
                        'dueDate' => $creditbalance->dueDate,
                    ];
                } else {
                    $credit_data = [
                        'agentId' => $data['agentId'],
                        'dueDate' => $data['dueDate'],
                        'balance' => $creditAmount,
                    ];
                }

                $creditbalance->fill($credit_data)->save();
            } else {
                $credit_data = [
                    'agentId' => $data['agentId'],
                    'dueDate' => $data['dueDate'],
                    'balance' => $data['creditAmount'],
                    'consumedCredit' => 0,
                    'paidCredit' => 0,
                ];
                AgentCreditBalance::create($credit_data);
            }
            request()->session()->flash('success', 'Credit given to the agent successfully');
            return redirect()->route('agent-credit.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request, $agentId)
    {
        $agent = AgentProfile::where('userId', $agentId)->firstorfail();
        $data = Credit::where('agentId', $agentId)->latest()
            ->where('creditAmount', '>', 0)
            ->when($request->startDate, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->startDate);
            })
            ->when($request->endDate, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->endDate);
            })
            ->when($request->agentId, function ($query) use ($request) {
                $query->where('agentId', $request->agentId);
            })
            ->with(['agent', 'agent.agent_profile'])
            ->paginate(15);
        return view('admin.credit.history', compact('data', 'agent'));
    }
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $type)
    {
        // dd($type);
        $credit = Credit::find($id);
        $agent = $this->getAgent();
        $type = $type;

        return view('admin.credit.form', compact('credit', 'agent', 'type'));
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
        $credit = Credit::findorfail($id);
        $request['agentId'] = $credit->agentId;
        $data = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'dueDate' => 'nullable|date|after:today',
            'agentId' => 'required|exists:users,id',
            'creditAmount' => 'nullable',
            'type' => 'required|in:credit,advance'
        ])->validate();


        // $data = $request->validated();
        $data['updatedBy'] = auth()->id();


        DB::beginTransaction();

        try {
            $creditbalance = AgentCreditBalance::where('agentId', $data['agentId'])->first();
            $balance = $creditbalance->balance - $credit->creditAmount;
            $creditbalance->update(['balance' => $balance]);
            $credit->update($data);

            $dueDate = Credit::select('dueDate')->where('agentId', $credit->agentId)->latest('dueDate')->first();
            $setDueDate = optional($dueDate->dueDate)->format('Y-m-d') ?? $data['dueDate'];

            $balance = $creditbalance->balance + $data['creditAmount'];
            $creditbalance->update(['balance' => $balance, 'dueDate' => $setDueDate]);

            DB::commit();
            request()->session()->flash('success', 'Credit updated given to the agent successfully');
            return redirect()->route('agent-credit.index');
        } catch (\Throwable $th) {
            DB::rollback();
            request()->session()->flash('error', 'Credit cannot be updated at the moment, please try again');
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
    }

    public function getAgent()
    {
        return User::with('roles')->with('agent_profile')->get()->filter(function ($user, $key) {
            return $user->hasRole('Agent');
        })->mapWithKeys(function ($agent) {
            return [$agent->id => $agent->agent_profile->company_name ??  $agent->name['en']];
        });
    }
}
