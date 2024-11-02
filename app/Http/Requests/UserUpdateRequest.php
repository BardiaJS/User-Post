<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
                'email' => 'required|email' ,
                'is_admin' =>'sometimes' ,
                'avatar' => 'required'
        ];
    }
}
