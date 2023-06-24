<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $partners = Partner::latest()
            ->when($request->keyword, function ($partner) use ($request) {
                return $partner->where('title', 'like', "%$request->keyword%");
            })
            ->paginate(15);
        return view('admin.partners.list', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partner = new Partner();
        return view('admin.partners.form', compact('partner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        $data = $request->validated();
        try {
            Partner::create($data);
            request()->session()->flash('success', 'Partner has been added successfully');
            return redirect()->route('partners.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Partner cannot be added at the moment. Try again');
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
        $partner = Partner::findorfail($id);
        return view('admin.partners.form', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, $id)
    {
        $partner = Partner::findorfail($id);

        $data = $request->validated();
        unset($data['slug']);
        try {
            $partner->update($data);
            request()->session()->flash('success', 'Partner has been updated successfully');
            return redirect()->route('partners.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Partner cannot be updated at the moment. Try again');
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
        $partner = Partner::findorfail($id);
        try {
            $partner->delete();
            request()->session()->flash('success', 'Partner has been deleted successfully');
            return redirect()->route('partners.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Partner cannot be deleted at the moment. Try again');
            return redirect()->back();
        }
    }
}
