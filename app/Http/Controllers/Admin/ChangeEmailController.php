<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChangeEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Super Admin');
    }

    public function changeEmail(Request $request, $userId)
    {
        $user = User::findorfail($userId);
        $data =   $this->validate($request, [
            'email' => 'required|unique:users,email'
        ]);
        try {
            $user->update(['email' => $request->email]);
            request()->session()->flash('success', 'User Email Changed Successfully');
            return redirect()->back();
        } catch (\Throwable $th) {
            request()->session()->flash('success', 'User Email cannot be changed. Please try again later');
            return redirect()->back();
        }
    }
}
