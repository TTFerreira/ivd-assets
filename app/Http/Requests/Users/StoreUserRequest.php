<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'name' => 'required|unique:users,name',
        'email' => 'required|unique:users,email|email',
        'password' => 'required|min:6'
      ];
    }

    /**
     * Custom error messages for fields
     *
     * @return array
     */
    public function messages()
    {
      return [
        'name.required' => 'You must enter the User\'s Name.',
        'name.unique' => $this->name . ' already exists. You must enter a unique User Name.',
        'email.required' => 'You must enter the User\'s Email Address.',
        'email.unique' => $this->email . ' already exists. You must enter a unique email address.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'You must enter a password.',
        'password.min' => 'The password must be a minimum of 6 characters long.'
      ];
    }
}
