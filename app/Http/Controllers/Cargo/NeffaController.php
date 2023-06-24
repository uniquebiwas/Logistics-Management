<?php

namespace App\Http\Controllers\Cargo;

use App\Http\Controllers\Controller;
use App\Http\Requests\NeffaRequest;
use Illuminate\Http\Request;
use App\Models\NepalFrightForwardersAssociation;
use Barryvdh\DomPDF\Facade  as PDF;


class NeffaController extends Controller
{
    public function index(Request $request)
    {
        $neffa = NepalFrightForwardersAssociation::latest()
            ->when($request->keyword, fn ($query) => $query->where('referenceNumber', 'like', "%$request->keyword%"))
            ->paginate(30);
        return view('admin.cargo.neffa.index', compact('neffa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $neffa = new  NepalFrightForwardersAssociation();
        return view('admin.cargo.neffa.form', compact('neffa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NeffaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NeffaRequest $request)
    {
        $data   = $request->validated();
        try {
            $data['createdBy'] = Auth()->id();
            $neffa =  NepalFrightForwardersAssociation::create($data);
            request()->session()->flash('success', 'data created successfully');
            return redirect()->route('neffa.show', $neffa->id);
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
        $neffa = NepalFrightForwardersAssociation::findorfail($id);
        // return view('admin.cargo.neffa.show', compact('neffa'));
        $pdf = PDF::loadView('admin.cargo.neffa.show', compact('neffa'));
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
        $neffa = NepalFrightForwardersAssociation::findorfail($id);


        return view('admin.cargo.neffa.form', compact('neffa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\NeffaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NeffaRequest $request, $id)
    {
        $certification =  NepalFrightForwardersAssociation::findOrFail($id);
        $data   = $request->validated();
        try {
            $data['updatedBy'] = Auth()->id();
            $certification->update($data);
            request()->session()->flash('success', 'data updated successfully');
            return redirect()->route('neffa.show', $certification->id);
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
        $certification =  NepalFrightForwardersAssociation::findOrFail($id);

        try {
            $certification->delete();
            request()->session()->flash('success', 'data delete successfully');
            return redirect()->route('neffa.index');
        } catch (\Throwable $th) {
            request()->session()->flash('error', $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
