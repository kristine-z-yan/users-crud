<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
      /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user= User::find($this->id);
        return [
            'first_name' => 'required|string|max:255|',
            'last_name' => 'required|string|max:255|',
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('user')->id,
            'country_id' => 'required|integer',
            'roles' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required'  => 'Email is required',
            'email.unique'  => 'There is an account with this email. Please change it.',
            'country_id.required'  => 'Country is required.Please select from list',
            'roles.required'  => 'Roles is required.Please select from list',
        ];
    }
}
