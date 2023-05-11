<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;


class GetUsersRequest extends FormRequest
{
    
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdmin;
    }


    public function rules()
    {
        return [
            'is_admin' => 'boolean',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => 'validation_failed',
            'messages' => $validator->errors(),
        ], 422));
    }
}