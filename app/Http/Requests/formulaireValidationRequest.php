<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class formulaireValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:8',
            'repassword' => 'required|min:8',
        ];
    } #end method
    public function messages()
    {
        return [
            'username.required' => 'Please enter username.',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Please enter valid email address.',
        ];
    }
}
