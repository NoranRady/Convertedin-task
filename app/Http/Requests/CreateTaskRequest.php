<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;


class CreateTaskRequest extends FormRequest
{
    
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdmin;
    }


    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required',
            'assigned_to' => 'required|exists:users,id',
            'assigned_by' => 'required|exists:users,id'
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