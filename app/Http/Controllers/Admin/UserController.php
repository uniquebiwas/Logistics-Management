<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Reporter;
use App\Models\Advertisement;
use App\Utilities\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Str;


class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->get_web();
    }

    public function index(Request $request)
    {
        $userRole = request()->user()->roles->first()->name;
        $all_users = $this->user
            ->whereHas('roles', function ($query) {
                $query->whereNotIn('name',  ['Staff', 'Agent', 'Super Admin']);
            })
            ->orderBy('name', 'ASC')
            ->paginate();

        return view('admin.users.user-list')->with('data', $all_users, 'userRole', $userRole);
    }
    protected function getRoleList()
    {
        $userRole = request()->user()->roles->first()->name;
        $roles = Role::WhereNotIn('name', ['Agent', 'Staff'])->pluck('name', 'name')->all();
        if ($userRole != 'Super Admin') {
            $roles = Role::whereNotIn('name', ['Super Admin', 'Agent', 'Staff'])->pluck('name', 'name')->all();
        }
        return $roles;
    }

    public function create()
    {
        $roles = $this->getRoleList();

        return view('admin.users.user-form', compact('roles'));
    }

    public function store(Request $request)
    {
        $rules = $this->user->getRules();

        $request->validate($rules);
        $data = [
            'name' => [
                'en' => $request->en_name ?? $request->np_name,
                'np' => $request->np_name ?? $request->en_name,
            ],
            'publish_status' => $request->publish_status,
            'email' => $request->email,
        ];
        $data['slug'] = $this->checkUniqueSlug($request->en_name ?? $request->np_name);
        $data['password'] = Hash::make($request->password);
        $data['type'] = 'admin';
        $data['profileImage'] = $request->profileImage;
        $this->user->fill($data);
        $status = $this->user->save();

        if ($status) {
            $this->user->assignRole($request->input('roles'));
            $request->session()->flash('success', "User Created Successfully");
        } else {
            $request->session()->flash('error', "Sorry! Error While Adding the new user");
        }
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            abort(404);
        }
        $title = @$user->name['en'] . ' Profile';
        return view('admin.users.user-detail', compact('user', 'title'));
    }

    public function edit($id)
    {
        $this->user = $this->user->find($id);
        if (!$this->user) {
            request()->session()->flash('error', 'Error ! User Not Found');
            return redirect()->back();
        }
        $roles = $this->getRoleList();
        $userRole = $this->user->roles->pluck('name', 'name')->all();
        return view('admin.users.user-form', compact('roles', 'userRole'))->with('user_detail', $this->user);
    }

    public function update(Request $request, $id)
    {
        $this->user = $this->user->find($id);
        if (!$this->user) {
            request()->session()->flash('error', 'Eror ! User Not Found');
            return redirect()->back();
        }
        $rules = $this->user->getRules('update', $id);
        $request->validate($rules);
        $data = [
            'name' => [
                'en' => $request->en_name ?? $request->np_name,
                'np' => $request->np_name ?? $request->en_name,
            ],
            'publish_status' => $request->publish_status,
        ];
        if (isset($request->change_password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $this->user->password; //if password comes blank set old password
        }

        if ($request->profileImage) {
            $data['profileImage'] = $request->profileImage;
        }
        $this->user->fill($data);
        $status = $this->user->save();
        if ($status) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $this->user->assignRole($request->input('roles'));
            $request->session()->flash('success', "User Updated Successfully");
        } else {
            $request->session()->flash('error', "Sorry! Error While Updating the user");
        }
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->user = $this->user->find($id);
        if (!$this->user || $this->user->id == request()->user()->id) {
            request()->session()->flash('error', 'Eror ! You Can Not Delete Your Self');
            return redirect()->back();
        }
        $status = $this->user->delete();
        if ($status) {
            request()->session()->flash('success', "User Deleted Successfully");
        } else {
            request()->session()->flash('error', "Sorry! Error While Deleting the new user");
        }
        return redirect()->route('users.index');
    }

    public function profiledetail()
    {
        $userRole = request()->user()->roles->first()->name;
        $advertisement = Advertisement::where('created_by', auth()->user()->id)->count();
        // if($userRole == 'Reporter'){
        //     dd(Reporter::where('id', auth()->user()->id))->first();
        // }

        // dd($advertisement);
        return view('admin.auth.profile', compact('advertisement'));
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password_confirmation' => 'required',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ]);
        $this->user = $this->user->find($id);
        if (!$this->user) {
            $request->session()->flash('error', 'User not found');
            return redirect(route('users.index'));
        }
        $data = $request->except('name');
        // dd($data);
        if (!Hash::check($data['current_password'], auth()->user()->password)) {
            return back()->with('warning', 'Current Password Not Matched.');
        } else {
            $data['password'] = Hash::make($request->password);
            $data['password_reset_at'] = now();
            $this->user->fill($data);
            $status = $this->user->save();
            if ($status) {
                LogActivity::addToLog("Password Changed Successfully");
                $request->session()->flash('success', 'Password Updated Successfully');
            } else {
                $request->session()->flash('error', 'Sorry! Error While Updating the Password');
            }
            Auth::logout();
            return redirect()->route('dashboard.index');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/login');
    }

    public function recovery()
    {
        return view('admin.auth.two-factor-recovery');
    }
    public function ban($id)
    {
        User::where('id', $id)->update(['status' => '2']);
        return redirect()->back();
    }
    public function unban($id)
    {
        User::where('id', $id)->update(['status' => '1']);
        return redirect()->back();
    }
    public function usersNews(Request $request, $slug)
    {
        $news_user =  $this->user->where('id', $slug)
            // ->orWhere('slug', $slug)
            ->first();
        // dd($news_user);
        abort_if(!$news_user, 404);
        $news_users_news  = News::where('userId', $news_user->id)
            ->with('newsHasCategories')
            ->paginate(10);
        // dd($news_users_news);
        $data =  [
            'news_user' => $news_user,
            'news_users_news' => $news_users_news,
        ];
        return view('admin.profile.reporter-news', $data);
    }
    protected function checkUniqueSlug($user)
    {

        $slug = User::where('slug',  Str::slug($user))->first();
        if (!$slug) {
            return Str::slug($user);
        } else {
            return Str::slug($user) . '-' . Str::random(3);
        }
    }
    protected function numberexists(Request $request)
    {
        $checks = $this->user->where('mobile', $request->number)->count();
        return response($checks);
    }
}
