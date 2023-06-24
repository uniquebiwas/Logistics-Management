<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\ServiceAgent;
use App\Models\ServiceAgentCountries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceAgentController extends Controller
{
    public function __construct(ServiceAgent $serviceAgent)
    {
        $this->serviceAgent = $serviceAgent;
        $this->countries = Country::where('status', 'Active')->orderBy('name', 'ASC')->pluck('name', 'id');
    }

    protected function getserviceAgent($request)
    {
        $query = $this->serviceAgent->withCount('shipments');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getserviceAgent($request);
        return view('admin/serviceagent/list', compact('data'));
    }

    public function create(Request $request)
    {
        $serviceAgent_info = null;
        $countries = $this->countries;
        $title = 'Add New Service Agent';
        return view('admin/serviceagent/form', compact('serviceAgent_info', 'title', 'countries'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'api_url' => 'required|string|min:3|max:190',
            'publishStatus' => 'required|in:0,1'
        ]);
        $data = [
            'title' => $request->title,
            'publishStatus' => $request->publishStatus,
            'api_url' => $request->api_url,
            'created_by' => Auth::user()->id,
        ];
        try {
            DB::beginTransaction();
            $serviceAgent = ServiceAgent::create($data);
            $request->session()->flash('success', 'Service Agent added successfully.');
            DB::commit();
            return redirect()->route('serviceagent.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $serviceAgent_info = $this->serviceAgent->find($id);
        if (!$serviceAgent_info) {
            abort(404);
        }
        $title = 'Update Service Agent';
        return view('admin/serviceagent/form', compact('serviceAgent_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $serviceAgent_info = $this->serviceAgent->find($id);
        if (!$serviceAgent_info) {
            abort(404);
        }
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'api_url' => 'required|string|min:3|max:190',
            'publishStatus' => 'required|in:1,0'
        ]);
        $data = [
            'title' => $request->title,
            'publishStatus' => $request->publishStatus,
            'api_url' => $request->api_url,
            'updated_by' => Auth::user()->id,
        ];
        try {
            DB::beginTransaction();
            $serviceAgent_info->fill($data)->save();
            // $serviceAgent_info->countries()->sync($request->countries);
            $request->session()->flash('success', 'Service Agent updated successfully.');
            DB::commit();
            return redirect()->route('serviceagent.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $serviceAgent_info = $this->serviceAgent->find($id);
        if (!$serviceAgent_info) {
            abort(404);
        }
        try {
            $serviceAgent_info->updated_by = Auth::user()->id;
            $serviceAgent_info->save();
            $serviceAgent_info->delete();
            $request->session()->flash('success', 'Service Agent deleted successfully.');
            return redirect()->route('serviceagent.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
}
