<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function __construct(Location $location)
    {
        $this->middleware(['role:Super Admin|Admin|AWB admin', 'permission:location-create'], ['only' => ['create', 'store']]);
        $this->middleware(['role:Super Admin|Admin|AWB admin', 'permission:location-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['role:Super Admin|Admin|AWB admin', 'permission:location-delete'], ['only' => ['destroy']]);
        $this->location = $location;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type = null)
    {

        $locationIndex = $this->location
            ->when($type, fn ($query) => $query->where('type', $type))
            ->orderBy('title', 'Asc')
            ->paginate(20);
        return view('admin.location.index', compact('locationIndex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        $location = new Location();
        $location->type = $type;
        return view('admin.location.form', compact('location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type = null)
    {
        $data =  $this->validate($request, $this->getRules(null));

        try {
            $this->location->create($data);
            request()->session()->flash('Success', 'Location created Successfully');
            return redirect()->route('location.index',['type'=>$type]);
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Location cannot be created at the moment.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type = null)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $type = null)
    {
        $location =   $this->location->findorfail($id);
        return view('admin.location.form', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type = null)
    {
        $data =  $this->validate($request, $this->getRules($id));
        $locationUpdate =   $this->location->findorfail($id);

        try {
            $locationUpdate->update($data);
            request()->session()->flash('Success', 'Location updated Successfully');
            return redirect()->route('location.index',['type'=>$type]);
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Location cannot be updated at the moment.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $type = null)
    {
        $locationUpdate =   $this->location->findorfail($id);

        try {
            $locationUpdate->delete();
            request()->session()->flash('Success', 'Location deleted Successfully');
            return redirect()->route('location.index',['type'=>$type]);
        } catch (\Throwable $th) {
            request()->session()->flash('error', 'Location cannot be deleted at the moment.');
            return redirect()->back();
        }
    }

    public function getRules($locationId)
    {
        return [
            'title' => [
                'required',
                'unique:locations,title,' . $locationId,
                'min:2',
                'max:191',
            ],
            'type' => 'nullable'
        ];
    }
}
