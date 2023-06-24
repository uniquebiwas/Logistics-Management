<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent\AgentDocument;
use App\Models\Agent\AgentProfile;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AgentController extends Controller
{
    public function __construct(User $agent)
    {
        $this->middleware(['permission:agent-list|agent-create|agent-edit|agent-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:agent-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:agent-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:agent-delete'], ['only' => ['destroy']]);
        $agentId = UserType::where('typeId', USER_TYPE['agent'])->pluck('userId');
        // dd($agentId);
        $this->agent = $agent->whereIn('id', $agentId);
    }

    protected function getagent($request)
    {
        $query = $this->agent->with('agent_profile');
        if ($request->start_date && $request->end_date) {
            $start_date = date('Y-m-d 00:00:00', strtotime($request->start_date));
            $end_date = date('Y-m-d 23:59:59', strtotime($request->end_date));
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        } elseif ($request->start_date) {
            $start_date = date('Y-m-d 00:00:00', strtotime($request->start_date));
            $end_date = date('Y-m-d 23:59:59');
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }
        if ($request->created_at) {
            $created_at_start = date($request->created_at . ' 00:00:00');
            $created_at_end = date($request->created_at . ' 23:59:59');
            $query = $query->whereBetween('created_at', [$created_at_start, $created_at_end]);
        }
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where(function ($qr) use ($keyword) {
                $qr->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('mobile', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
        }
        return $query->orderBy('id', 'DESC')->paginate(20);
    }
    public function index(Request $request)
    {
        $data = $this->getagent($request);
        return view('admin/agent/list', compact('data'));
    }

    public function create(Request $request)
    {
        $countries = Country::pluck('name', 'id');
        $agent_info = new User();
        $title = 'Add Agent/Company';
        return view('admin/agent/form', compact('agent_info', 'title', 'countries'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'en_name' => 'required|string|max:50',
            'email' => 'nullable|email:rfc,dns',
            'mobile' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',

        ]);
        $data = $request->only('email', 'mobile', 'publishStatus');
        $data['name'] = [
            'en' => $request->en_name,
            'np' => $request->en_name,
        ];
        $data['profileImage'] = $request->profileImage;
        $data['password'] = Hash::make($request->password);
        if ($request->emailVerified == 'on') {
            $data['emailVerifiedAt'] = date('Y-m-d H:i:s');
        }
        if ($request->phoneVerified == 'on') {
            $data['phoneVerifiedAt'] = date('Y-m-d H:i:s');
        }
        if ($request->documentVerified == 'on') {
            $data['documentVerifiedAt'] = date('Y-m-d H:i:s');
        }
        DB::beginTransaction();
        try {

            $role = Role::where('name', 'Agent')->first();
            $agent = $this->agent->create($data);
            // dd($agent);
            $agent->assignRole([$role->id]);
            $data_UserType = [
                'userId' => $agent->id,
                'typeId' => USER_TYPE['agent'],
            ];
            $data_AgentProfile = [
                'userId' => $agent->id,
                'company_name' => $request->company_name,
                'state' => $request->state,
                'city' => $request->city,
                'country' => $request->country,
                'address' => $request->address,
                'phone' => $request->companyPhone,
                'designation' => $request->designation,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'website' => $request->website,
                'slug' => $request->en_name ? Str::slug($request->en_name) : Str::slug($request->np_name),
                'company_logo_url' => $request->company_logo_url,
                'company_phone' => $request->company_phone,
                'accountant_name' => $request->accountant_name,
                'accountant_email' => $request->accountant_email,
                'accountant_phone' => $request->accountant_phone,
                'vatNumber' => $request->vatNumber

            ];
            UserType::create($data_UserType);
            AgentProfile::create($data_AgentProfile);
            DB::commit();
            $request->session()->flash('success', 'Agent profile created successfully.');
            return redirect()->route('agents.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        $agent_info = $this->agent->with('agent_profile')->find($id);
        if (!$agent_info) {
            abort(404);
        }
        $title = 'Update Agent';
        $countries = Country::pluck('name', 'id');
        return view('admin/agent/form', compact('agent_info', 'title', 'countries'));
    }

    public function show($id)
    {
        $agent_info = $this->agent->find($id);
        if (!$agent_info) {
            abort(404);
        }
        $title = @$agent_info->name['en'] . ' Profile';
        $data = AgentDocument::where('agentId', $agent_info->id)->paginate(10);
        // dd($data);
        return view('admin/agent/show', compact('agent_info', 'title', 'data'));
    }

    public function update(Request $request, $id)
    {
        $agent_info = $this->agent->find($id);
        if (!$agent_info) {
            abort(404);
        }
        $this->validate($request, [
            'en_name' => 'required|string|max:50',
            'mobile' => 'required|numeric',
            'email' => 'required|email'
        ]);
        $data = $request->only('mobile', 'publishStatus', 'accountNumber', 'email');
        $data['name'] = [
            'en' => $request->en_name,
            'np' => $request->en_name,
        ];
        if ($request->profileImage) {
            $data['profileImage'] = $request->profileImage;
        }
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        try {
            $agent_info->fill($data)->save();
            $data_AgentProfile = [
                'company_name' => $request->company_name,
                'state' => $request->state,
                'city' => $request->city,
                'country' => $request->country,
                'address' => $request->address,
                'phone' => $request->companyPhone,
                'designation' => $request->designation,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'website' => $request->website,
                'slug' => $request->en_name ? Str::slug($request->en_name) : Str::slug($request->np_name),
                'company_logo_url' => $request->company_logo_url,
                'company_phone' => $request->company_phone,
                'accountant_name' => $request->accountant_name,
                'accountant_email' => $request->accountant_email,
                'accountant_phone' => $request->accountant_phone,
                'vatNumber' => $request->vatNumber
            ];
            if ($request->company_logo_url) {
                $data_AgentProfile['company_logo_url'] = $request->company_logo_url;
            }

            $agent_info->agent_profile->fill($data_AgentProfile)->save();
            $request->session()->flash('success', 'Agent updated successfully.');
            return redirect()->route('agents.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function verifyDocument(Request $request, $id)
    {
        $agent_info = $this->agent->find($id);
        if (!$agent_info) {
            abort(404);
        }
        $agent_docs = AgentDocument::where('agentId', $id)->get();
        try {
            if ($agent_docs) {
                $data = [
                    'verifiedAt' => date('Y-m-d'),
                    'verifiedBy' => Auth::user()->id,
                    'status' => 'verified',
                ];

                foreach ($agent_docs as $docs) {
                    $docs->fill($data)->save();
                }
            }
            $agent_info->documentVerifiedAt = date('Y-m-d H:i:s');
            $agent_info->save();
            $request->session()->flash('success', 'Documents verified successfully.');
            return redirect()->back();
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function verifyEmail(Request $request, $id)
    {
        $agent_info = $this->agent->find($id);
        if (!$agent_info) {
            abort(404);
        }
        try {
            $agent_info->emailVerifiedAt = date('Y-m-d H:i:s');
            $agent_info->save();
            $request->session()->flash('success', 'Email verified successfully.');
            return redirect()->back();
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function verifyPhone(Request $request, $id)
    {
        $agent_info = $this->agent->find($id);
        if (!$agent_info) {
            abort(404);
        }
        try {
            $agent_info->phoneVerifiedAt = date('Y-m-d H:i:s');
            $agent_info->save();
            $request->session()->flash('success', 'Phone verified successfully.');
            return redirect()->back();
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $agent_info = $this->agent->find($id);
        if (!$agent_info) {
            abort(404);
        }
        try {
            $agent_info->delete();
            $data['updated_by'] = Auth::user()->id;
            $request->session()->flash('success', 'agent deleted successfully.');
            return redirect()->back();
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
    public function requestDocument(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $delete = AgentDocument::where('agentId', $request->agentId)->where('documentType', $request->documentType)->delete();
            // dd($delete);
            AgentDocument::create([
                'agentId' => $request->agentId,
                'documentType' => $request->documentType,
                'status' => 'requested',
            ]);
            DB::commit();
            $request->session()->flash('success', 'Document Requested Successfully.');
            return redirect()->back();
        } catch (\Exception $error) {
            DB::rollBack();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function verifyIndiDocument(Request $request, $id)
    {
        $document = AgentDocument::find($id);
        if (!$document) {
            request()->session()->flash('error', 'Error ! Worker Document Not Found');
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $document->verifiedAt = date('Y-m-d');
            $document->verifiedBy = Auth::user()->id;
            $document->status = 'verified';
            $document->save();
            DB::commit();
            $request->session()->flash('success', 'Document status updated successfully.');
            return redirect()->to(url()->previous());
        } catch (\Exception $error) {
            DB::rollback();
            $request->session()->flash('error', $error->getMessage());
            return redirect()->to(url()->previous());
        }
    }
}
