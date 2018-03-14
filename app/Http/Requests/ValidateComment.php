<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateComment extends FormRequest
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
            if ($this->request->has('user_id') && auth()->user()->id != $this->request->get('user_id')) {
                $validator->errors()->add('message', 'Something errors');
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
            'body' => 'required|max:255'
        ];
    }
}
