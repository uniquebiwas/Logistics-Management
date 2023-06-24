<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Team;
use App\Traits\CacheTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public $team;
    use CacheTrait;
    public function __construct(Team $team, Designation $designation)
    {
        $this->middleware(['permission:team-list|team-create|team-edit|team-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:team-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:team-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:team-delete'], ['only' => ['destroy']]);
        $this->team = $team;
        $this->designation = $designation;
    }

    protected function getTeam($request)
    {
        $query = $this->team->orderBy('id', 'DESC')->with('designation');
        if ($request->keyword) {
            $keyword = $request->keyword;
            $query = $query->where('full_name', 'LIKE', "%$keyword%");
        }
        return $query->paginate(20);
    }

    protected function getDesignation()
    {
        $designations = Designation::select('id', 'title')
            ->where('publish_status', '1')
            ->get()
            ->mapWithKeys(function ($item, $key) {
                return [
                    $item->id => $item->title['en'],
                ];
            });

        return $designations;
    }
    public function index(Request $request)
    {
        $data = $this->getTeam($request);
        return view('admin/team/list', compact('data'));
    }

    public function create(Request $request)
    {
        $team_info = null;
        $title = 'Add Team';
        $designations = $this->getDesignation();
        return view('admin/team/form', compact('team_info', 'title', 'designations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'en_full_name' => 'string|min:3|max:190',
            'np_full_name' => 'string|min:3|max:190',
            'publish_status' => 'required|numeric|in:1,0',
        ]);
        $data = [
            'full_name' => [
                'en' => htmlentities($request->en_full_name),
                'np' => htmlentities($request->np_full_name),
            ],
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'publish_status' => $request->publish_status,
            'description' => [
                'en' => htmlentities($request->en_description),
                'np' => htmlentities($request->np_description),
            ],
            'created_by' => Auth::user()->id,
            'designation_id' => $request->designation_id == 0 ? null : $request->designation_id,
            'image' => $request->filepath ?? null,
        ];

        try {
            if ($request->filepath) {
                moveImage($request->filepath, teamImagePath);
            }
            $this->team->fill($data)->save();
            //            dd($data);
            $request->session()->flash('success', 'Team created successfully.');
            $this->forgetTeamCache();
            return redirect()->route('team.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $team_info = $this->team->find($id);
        $designations = $this->getDesignation();
        if (!$team_info) {
            abort(404);
        }
        // dd($designations);
        $title = 'Update Team';
        return view('admin/team/form', compact('team_info', 'title', 'designations'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $team_info = $this->team->find($id);
        if (!$team_info) {
            abort(404);
        }
        $this->validate($request, [
            'en_full_name' => 'string|min:3|max:190',
            'np_full_name' => 'string|min:3|max:190',
            'publish_status' => 'required|numeric|in:1,0',
        ]);
        $data = [
            'full_name' => [
                'en' => htmlentities($request->en_full_name),
                'np' => htmlentities($request->np_full_name),
            ],
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'publish_status' => $request->publish_status,
            'description' => [
                'en' => htmlentities($request->en_description),
                'np' => htmlentities($request->np_description),
            ],
            'created_by' => Auth::user()->id,
            'designation_id' => $request->designation_id,
            'image' => $request->filepath ?? null,
        ];
        if ($request->image && $request->image_name) {
            moveImage($request->image_name, teamImagePath);
            if ($team_info) {
                $oldImage = $team_info->image;
                if ($request->image_name != $oldImage) {
                    removeImage($oldImage, teamImagePath);
                }
            }
            $data['image'] = $request->image_name;
        }

        try {
            $team_info->fill($data)->save();
            $request->session()->flash('success', 'Team updated successfully.');
            $this->forgetTeamCache();
            return redirect()->route('team.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        $team_info = $this->team->find($id);
        if (!$team_info) {
            abort(404);
        }
        try {
            $team_info->delete();
            $data['updated_by'] = Auth::user()->id;
            $request->session()->flash('success', 'Team deleted successfully.');
            cache()->forget('app_members');
            $this->forgetTeamCache();

            return redirect()->route('team.index');
        } catch (\Exception $error) {
            $request->session()->flash('error', $error->getMessage());
            return redirect()->back();
        }
    }
}
