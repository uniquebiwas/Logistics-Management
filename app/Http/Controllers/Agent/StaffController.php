<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staff = User::query()
            ->where('agentId', auth()->id())
            ->when($request->startDate, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->startDate);
            })
            ->when($request->endDate, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->endDate);
            })
            ->when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'like', "%$request->keyword%");
                    // ->orWhere('email', 'like', "%$request->keyword%");
            })
            ->paginate(10);
        return view('agent.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_detail = new User();
        return view('agent.staff.form', compact('user_detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        $data =  $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['agentId'] = auth()->id();
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $user->assignRole('Staff');
            DB::commit();
            request()->session()->flash('success', 'Staff added successfully');
            return redirect()->route('agent-staff.index');
        } catch (\Error $error) {
            DB::rollback();
            request()->session()->flash('error', 'Staff Cannot be Added successfully');

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
        $staff = User::where('agentId', auth()->id())->findorfail($id);
        return view('agent.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_detail = User::where('agentId', auth()->id())->findorfail($id);
        return view('agent.staff.form', compact('user_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffUpdateRequest $request, $id)
    {
        $user_detail = User::where('agentId', auth()->id())->findorfail($id);
        $data = $request->validated();
        $data['password'] = $data['password'] ? Hash::make($data['password']) : $user_detail->password;
        DB::beginTransaction();
        try {
            $user_detail->update($data);
            DB::commit();

            request()->session()->flash('success', 'The Staff has been updated Successfully');
            return redirect()->route('agent-staff.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            request()->session()->flash('error', 'The Staff Cannot be uodated Please Try again later');
            return redirect()->route('agent-staff.index');
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
    }
}
