<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{
    public function __construct(Feature $feature)
    {
        $this->middleware(['permission:feature-list|feature-create|feature-edit|feature-delete'], ['only' => ['index','store']]);
        $this->middleware(['permission:feature-create'], ['only' => ['create','store']]);
        $this->middleware(['permission:feature-edit'], ['only' => ['edit','update']]);
        $this->middleware(['permission:feature-delete'], ['only' => ['destroy']]);
        $this->feature = $feature;
    }

    protected function getQuery($request)
    {
        if($request->status=='1'){
            $query = $this->feature->orderBy('position','asc')->where('publish_status','1');
        }
        elseif ($request->status=='0') {
            $query = $this->feature->orderBy('position','asc')->where('publish_status','0');
        }
        else {
            $query = $this->feature->orderBy('position','asc');
        }

        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('title',$keyword);
        }
        return $query->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getQuery($request);
        return view('admin/feature/list', compact('data'));
    }

    public function create()
    {
        $feature_info = null;
        $title = 'Add Service';
        return view('admin/feature/form', compact('feature_info', 'title'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'publish_status' => 'required|numeric|in:1,0'
        ]);
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_title' => $request->short_title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'icon' => $request->icon,
            'parallax_image' => $request->parallax_image,
            'feature_image' => $request->feature_image,
            'position' => $request->position,
            'publish_status' => $request->publish_status,
            'created_by' => Auth::user()->id,
        ];
        try {
            $this->feature->fill($data)->save();
            $request->session()->flash('success', 'Feature created successfully.');
            return redirect()->route('feature.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $feature_info = $this->feature->find($id);
        if (!$feature_info) {
            abort(404);
        }
        $title = 'Update Service';
        return view('admin/feature/form', compact('feature_info', 'title'));
    }

    public function update(Request $request, $id)
    {
        $feature_info = $this->feature->find($id);
        if (!$feature_info) {
            abort(404);
        }
        $this->validate($request, [
            'title' => 'required|string|min:3|max:190',
            'publish_status' => 'required|numeric|in:1,0'
        ]);
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_title' => $request->short_title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'position' => $request->position,
            'publish_status' => $request->publish_status,
            'status' => $request->status,
            'updated_by' => Auth::user()->id,
        ];

        if($request->icon){
            $data['icon'] = $request->icon;
        }
        if($request->featured_image){
            $data['featured_image'] = $request->featured_image;
        }
        if($request->parallax_image){
            $data['parallax_image'] = $request->parallax_image;
        }
        try {
            $feature_info->fill($data)->save();
            $request->session()->flash('success', 'Feature updated successfully.');
            return redirect()->route('feature.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $feature_info = $this->feature->find($id);
        if (!$feature_info) {
            abort(404);
        }
        try {
            $feature_info->delete();
            $data['updated_by'] = Auth::user()->id;
            $request->session()->flash('success', 'Feature deleted successfully.');
            return redirect()->route('feature.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    public function updateOrder(Request $request)
    {
        $features = Feature::all();
        // dd($request->all());
        foreach ($features as $feature) {
            $feature->timestamps = false; // To disable update_at field updation
            $id = $feature->id;

            foreach ($request->position as $position) {
                if ($position['id'] == $id) {
                    $feature->update(['position' => $position['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
}
