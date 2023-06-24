<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Controllers\Controller;
use App\Http\Requests\NccRequest;
use App\Models\Cargo\CertificationOfOriginNCC;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade  as PDF;

class NccController extends Controller
{
    public function index(Request $request)
    {
        $ncc = CertificationOfOriginNCC::latest()
            ->when($request->keyword, fn ($query) => $query->where('reference_no', 'like', "%$request->keyword%"))
            ->paginate(30);
        return view('admin.cargo.ncc.index', compact('ncc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ncc = new  CertificationOfOriginNCC();
        return view('admin.cargo.ncc.form', compact('ncc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NccRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NccRequest $request)
    {
        $data   = $request->validated();
        try {
            $data['createdBy'] = Auth()->id();
            $ncc =  CertificationOfOriginNCC::create($data);
            request()->session()->flash('success', 'data created successfully');
            return redirect()->route('ncc.show', $ncc->id);
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
        $ncc = CertificationOfOriginNCC::findorfail($id);
        // return view('admin.cargo.ncc.show', compact('ncc'));
        $pdf = PDF::loadView('admin.cargo.ncc.show', compact('ncc'));
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
        $ncc = CertificationOfOriginNCC::findorfail($id);
        return view('admin.cargo.ncc.form', compact('ncc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\NccRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NccRequest $request, $id)
    {
        $certification =  CertificationOfOriginNCC::findOrFail($id);
        $data   = $request->validated();
        try {
            $data['updatedBy'] = Auth()->id();
            $certification->update($data);
            request()->session()->flash('success', 'data updated successfully');
            return redirect()->route('ncc.show', $certification->id);
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
        $certification =  CertificationOfOriginNCC::findOrFail($id);

        try {
            $certification->delete();
            request()->session()->flash('success', 'data delete successfully');
            return redirect()->route('ncc.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
