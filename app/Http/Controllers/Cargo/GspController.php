<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Controllers\Controller;
use App\Http\Requests\GspRequest;
use App\Models\Cargo\CertificationOfOriginGSP;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;


class GspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gsp = CertificationOfOriginGSP::latest()
        ->when($request->keyword, fn ($query) => $query->where('reference_no', 'like', "%$request->keyword%"))
        ->paginate(30);
        return view('admin.cargo.gsp.index', compact('gsp'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gsp = new  CertificationOfOriginGSP();
        return view('admin.cargo.gsp.form', compact('gsp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\GspRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GspRequest $request)
    {

        $data   = $request->validated();
        try {
            $data['createdBy'] = Auth()->id();
            $gsp =  CertificationOfOriginGSP::create($data);
            request()->session()->flash('success', 'data created successfully');
            return redirect()->route('gsp.show', $gsp->id);
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
    public function show($id)
    {
        $gsp = CertificationOfOriginGSP::findorfail($id);
        $pdf = PDF::loadView('admin.cargo.gsp.show',compact('gsp'));
        $pdf->setPaper('A4');
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
        $gsp = CertificationOfOriginGSP::findorfail($id);
        return view('admin.cargo.gsp.form', compact('gsp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\GspRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GspRequest $request, $id)
    {
        $certification =  CertificationOfOriginGSP::findOrFail($id);
        $data   = $request->validated();
        try {
            $data['updatedBy'] = Auth()->id();
            $certification->update($data);
            request()->session()->flash('success', 'data updated successfully');
            return redirect()->route('gsp.show',$certification->id);
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
        try {
            $certification =  CertificationOfOriginGSP::findOrFail($id);
            $certification->delete();
            request()->session()->flash('success', 'data delete successfully');
            return redirect()->route('gsp.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
