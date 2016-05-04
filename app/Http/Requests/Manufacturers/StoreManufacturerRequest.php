<?php

namespace App\Http\Requests\Manufacturers;

use App\Http\Requests\Request;

class StoreManufacturerRequest extends Request
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
        'name' => 'required|unique:manufacturers,name'
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
