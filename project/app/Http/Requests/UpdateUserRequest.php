<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'    => [
                'string',
                'required',
            ],
            'email'   => [
                'required',
                
            ],
            'password'   => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
          
           
        ];
    }

    public function authorize()
    {
        return true;
    }
}