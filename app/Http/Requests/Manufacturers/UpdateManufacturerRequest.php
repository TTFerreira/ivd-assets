<?php

namespace App\Http\Requests\Manufacturers;

use App\Http\Requests\Request;

class UpdateManufacturerRequest extends Request
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
      $manufacturer = $this->route()->parameter('manufacturer');

      return [
        'name' => 'required|unique:manufacturers,name,'.$manufacturer->id
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
        'name.required' => 'You must enter a Manufacturer\'s Name.',
        'name.unique' => 'Manufacturer \'' . $this->name . '\' already exists. You must enter a unique Manufacturer Name.',
      ];
    }
}
