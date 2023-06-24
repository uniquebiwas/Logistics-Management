<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserType;

class ShowUserController extends Controller
{

    public function __construct(UserType $user)
    {
        $this->user = $user;
    }
    public function index(Request $request)
    {

        if ($request->has('type')) {
            $users =  $this->user->where('type', $request->type)->with('user')->paginate();
            return view('admin.users.userType',compact('users'));
        }
        $users = $this->user->with('user')->paginate();

        return view('admin.users.userType',compact('users'));
    }
}
