<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:10' ,
            'last_name'=> 'required|max:10',
            'display_name' => 'required|max:10',
            'email' => 'required|email|unique:users,email' ,
            'password' => 'required|confirmed|min:6' ,
            'is_admin' => 'sometimes|required'
         ];
    }
}
