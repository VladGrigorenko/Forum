<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordUser;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class UserController extends Controller
{

    public function show(User $user)
    {
        return view('profile.index', compact('user'));
    }


    public function updateAvatar(Request $request)
    {
        $manager = new ImageManager();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $manager->make($avatar)->resize(300, 300)->save(public_path('/images/' . $filename));
            auth()->user()->SetAvatar($filename);

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
