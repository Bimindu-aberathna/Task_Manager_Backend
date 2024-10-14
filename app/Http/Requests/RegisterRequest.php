<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=> 'required|min:5|max:100',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:6|max:25',
            'phone_number'=> 'required|digits:10|nullable',

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array{
        return[
            'name.required'=> 'Please enter a name',
            'name.min'=>'Name must absolutely be at least 5 chars long',
            'name.max'=>'Name must not more than 100 chars',
            'email.required'=> 'Please enter a email',
            'email.email'=> 'This email is already taken',
            'email.unique'=> 'Please enter a valid email',
            'password.required'=> 'Please enter a password',
            'password.min'=> 'Please enter at least 5 char password',
            'password.max'=> 'Please enter at not more max 25 chars password',
            'phone_number.required'=> 'Please enter a phone number',
            'phone_number.digits'=> 'Please enter at least 10 digits number',


        ];
    }
}
