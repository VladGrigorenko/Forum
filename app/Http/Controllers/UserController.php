<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Validator;

class UserController extends Controller
{

    public function index(User $user)
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
            $user = auth()->user()->SetAvatar($filename);

        }
        return back();
    }

    public function ValidatePassword(array $data)
    {
        $messages = [
            'old_password.required' => 'Please enter current password',
            'new_password.required' => 'Please enter password',
            'repeat_password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'old_password' => 'required',
            'new_password' => 'required| min:6 | different:old_password',
            'repeat_password' => 'required|same:new_password',
        ], $messages);

        return $validator;
    }


    public function changePassword(Request $request){

        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->ValidatePassword($request_data);
            if($validator->fails())
            {
                return back()->withErrors($validator);
            }
            else
            {
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['old_password'], $current_password))
                {
                    auth()->user()->ChangePassword($request_data['new_password']);

                    $alert = array('message' => 'The password change is successful');
                    return back()->withErrors($alert);
                }
                else
                {
                    $error = array('old_password' => 'Please enter correct current password');
                    return back()->withErrors($error);
                }
            }
        }
        else
        {
            return redirect()->home();
        }
    }
}
