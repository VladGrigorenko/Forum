<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            $current_password = auth()->user()->password;
            if (!Hash::check($this->request->get('old_password'), $current_password)) {
                $validator->errors()->add('old_password', 'Please enter correct current password');
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required| min:6 | different:old_password',
            'repeat_password' => 'required|same:new_password',
        ];
    }
}
