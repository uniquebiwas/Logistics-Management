<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Admin\MembershipPackage;
use App\Models\AgentMembershipHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MembershipPackageController extends Controller
{
    public function __construct(MembershipPackage $package)
    {
        $this->package = $package;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function getPackage($request)
    {
        $query = $this->package;
        if ($request->status != null) {
            $query = $query->where('publishStatus', $request->status);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where(function ($qr) use ($keyword) {
                $qr->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        //
        $packages = $this->getPackage($request);
        $data = [
            'title' => "All membership packages",
            'packages' => $packages
        ];
        return view('admin.membership.package-list', $data);
    }
    public function membershipHistory(Request $request)
    {
        $query = AgentMembershipHistory::orderBy('id', 'DESC');

        $boughtPackages = [];
        foreach ($query->get() as $key => $value) {
            $boughtPackages[$value->get_package->id] = $value->get_package->title['en'];
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('membershipPackageId', $keyword);
        }

        $agentPackageHistory = $query->paginate(10);
        $data = [
            'title' => "Membership Packages History",
            'data' => $agentPackageHistory,
            'boughtPackages' => $boughtPackages,
        ];
        return view('agent.membership.history.list', $data);
    }

    public function create()
    {
        //
        $data = [
            'title' => "Add New Package",
            'route' => route('membership.create')
        ];
        return view('admin.membership.package-create', $data);
    }

    protected function packageValidate()
    {
        if ($this->_website == 'Both') {
            $data = [
                "np_title" => "required|string|max:200",
                "en_title" => "required|string|max:200",
            ];
        } else if ($this->_website == 'Nepali') {
            $data = [
                "np_title" => "required|string|max:200",
            ];
        } else if ($this->_website == 'English') {
            $data = [
                "en_title" => "required|string|max:200",
            ];
        }
        $data['publish_status'] = "required|in:0,1";
        $data['package_amount'] = "required|numeric";
        $data['yearly_max_request'] = "required|numeric";
        return $data;
    }
    protected function mapPackage($request, $newsInfo = null)
    {
        $data = [
            "title" => [
                "np" => $request->np_title ?? $request->en_title,
                "en" => $request->en_title ?? $request->np_title,
            ],
            "description" => [
                'np' => htmlentities($request->np_description) ?? htmlentities($request->en_description),
                'en' => htmlentities($request->en_description) ?? htmlentities($request->np_description),
            ],
            "publishStatus" => $request->publish_status ?? '0',
            "package_amount" => htmlentities($request->package_amount) ?? '0',
            "yearly_max_request" => htmlentities($request->yearly_max_request) ?? '0',
            "slug" => $this->getSlug($request->en_title ?? $request->np_title),
        ];
        if ($request->image_url) {
            $data['image_url'] = $request->image_url;
        }
        return $data;
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, $this->packageValidate());
        try {
            DB::beginTransaction();
            $data = $this->mapPackage($request);
            $data['created_by'] = auth()->user()->id;
            $membershippackage = MembershipPackage::create($data);
            $request->session()->flash('success', 'Package created successfully.');
            DB::commit();
            return redirect()->route('membership.index');
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->to(url()->previous());
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
        $membership_info = $this->package->find($id);
        if (!$membership_info) {
            abort(404);
        }
        $data = [
            'title' => "Edit Package",
            'membership_info' => $membership_info,
            'route' => route('membership.create')
        ];
        return view('admin.membership.package-create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $membership_info = $this->package->find($id);
        if (!$membership_info) {
            abort(404);
        }
        $this->validate($request, $this->packageValidate());

        try {
            $data = $this->mapPackage($request);
            $membership_info->fill($data)->save();
            $request->session()->flash('success', 'Package updated successfully.');
            return redirect()->route('membership.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $membership_info = $this->package->find($id);
        if (!$membership_info) {
            abort(404);
        }
        try {
            $membership_info->delete();
            $request->session()->flash('success', 'Package deleted successfully.');
            return redirect()->route('membership.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    protected function getSlug($title)
    {
        $slug = Str::slug($title);
        $find = $this->package->where('slug', $slug)->first();
        if ($find) {
            $slug = $slug . '-' . rand(1111, 9999);
        }
        return $slug;
    }
}
