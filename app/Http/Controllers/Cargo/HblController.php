<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Controllers\Controller;
use App\Http\Requests\HblRequest;
use App\Models\HouseOfLading;
use Barryvdh\DomPDF\Facade  as PDF;

use Illuminate\Http\Request;

class HblController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hbl = HouseOfLading::latest()
            ->when($request->keyword, fn ($query) => $query->where('hblNumber', 'like', "%$request->keyword%")
                ->orWhere('shipmentReferenceNumber', 'like', "%$request->keyword%"))
            ->paginate(20);
        return view('admin.cargo.hbl.index', compact('hbl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hbl = new HouseOfLading();
        return view('admin.cargo.hbl.form', compact('hbl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HblRequest $request)
    {
        $data   = $request->validated();
        try {
            $data['createdBy'] = Auth()->id();
            $hbl =  HouseOfLading::create($data);
            request()->session()->flash('success', 'data created successfully');
            return redirect()->route('hbl.show', $hbl->id);
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
    public function show(Request $request, $id)
    {
        $hbl = HouseOfLading::findorfail($id);
        $hbl = collect($hbl)->transform(fn ($item, $key) =>  $item);
        $pdf = PDF::loadView('admin.cargo.hbl.show', compact('hbl'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('tests.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hbl = HouseOfLading::findorfail($id);
        return view('admin.cargo.hbl.form', compact('hbl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HblRequest $request, $id)
    {
        $certification =  HouseOfLading::findOrFail($id);
        $data   = $request->validated();
        try {
            $data['updatedBy'] = Auth()->id();
            $certification->update($data);
            request()->session()->flash('success', 'data updated successfully');
            return redirect()->route('hbl.show', $certification->id);
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
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
        $certification =  HouseOfLading::findOrFail($id);

        try {
            $certification->delete();
            request()->session()->flash('success', 'data delete successfully');
            return redirect()->route('hbl.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
