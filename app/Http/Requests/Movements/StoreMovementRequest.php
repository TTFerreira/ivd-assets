<?php

namespace App\Http\Requests\Movements;

use App\Http\Requests\Request;

class StoreMovementRequest extends Request
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
        'location_id' => 'required',
        'status_id' => 'required'
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
        'location_id.required' => 'You must select the Location.',
        'status_id.required' => 'You must select the Status.',
      ];
    }
}
