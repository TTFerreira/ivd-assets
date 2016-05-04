<?php

namespace App\Http\Requests\Locations;

use App\Http\Requests\Request;

class StoreLocationRequest extends Request
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
        'building' => 'required',
        'office' => 'required',
        'location_name' => 'required|unique:locations,location_name'
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
        'building.required' => 'You must enter the Building Number/Name.',
        'office.required' => 'You must enter the Office Number.',
        'location_name.required' => 'You must enter a Location Name.',
        'location_name.unique' => 'Location Name \'' . $this->location_name . '\' already exists. You must enter a unique Location Name.',
      ];
    }
}
