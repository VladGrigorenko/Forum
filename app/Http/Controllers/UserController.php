<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('profile.index', compact('user'));
    }

    public function updateAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            auth()->user()->SetAvatar($avatar);
        }
        return back();
    }

    public function updatePassword(ChangePasswordUser $request)
    {
        auth()->user()->ChangePassword($request['new_password']);
        $alert = array('message' => 'The password change is successful');

        return back()->withErrors($alert);
    }
}
