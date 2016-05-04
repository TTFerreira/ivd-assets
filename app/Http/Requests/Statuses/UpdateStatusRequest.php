<?php

namespace App\Http\Requests\Statuses;

use App\Http\Requests\Request;

class UpdateStatusRequest extends Request
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
      $status = $this->route()->parameter('status');

      return [
        'name' => 'required|unique:statuses,name,'.$status->id
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
        'name.required' => 'You must enter a Status.',
        'name.unique' => 'Status \'' . $this->name .'\' already exists. You must enter a unique Status.',
      ];
    }
}
