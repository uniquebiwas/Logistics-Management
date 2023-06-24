<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BenifitRequest;
use App\Models\Benifit;
use Illuminate\Http\Request;

class BenifitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benifits = Benifit::latest()->paginate(20);
        return view('admin.benefit.list', compact('benifits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $benifit = new Benifit();
        $title = 'benifit';
        return view('admin.benefit.form', compact('benifit', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BenifitRequest $request)
    {
        $data = $request->validated();
        try {
            Benifit::create($data);
            request()->session()->flash('success', 'Benifit Created Successfully');
            return redirect()->route('benefit.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Benifit  $benifit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Benifit  $benifit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $benifit = Benifit::findorfail($id);
        $title = 'benifit';
        return view('admin.benefit.form', compact('benifit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Benifit  $benifit
     * @return \Illuminate\Http\Response
     */
    public function update(BenifitRequest $request, $id)
    {
        $benifit = Benifit::findorfail($id);
        $data = $request->validated();
        try {
            $benifit->update($data);
            request()->session()->flash('success', 'Benifit Updated Successfully');
            return redirect()->route('benefit.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Benifit cannot be updated. try again');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Benifit  $benifit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $benifit = Benifit::findorfail($id);
        try {
            $benifit->delete();
            request()->session()->flash('success', 'Benifit deleted Successfully');
            return redirect()->route('benefit.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Benifit cannot be deleted. try again');
            return redirect()->back()->withInput();
        }
    }
}
