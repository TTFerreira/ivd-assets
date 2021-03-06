<?php

namespace App\Http\Requests\Divisions;

use App\Http\Requests\Request;

class UpdateDivisionRequest extends Request
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
      $division = $this->route()->parameter('division');

      return [
        'name' => 'required|unique:divisions,name,'.$division->id
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
        'name.required' => 'You must enter the Division Name.',
        'name.unique' => 'Division \'' . $this->name . '\' already exists. You must enter a unique Division Name.',
      ];
    }
}
