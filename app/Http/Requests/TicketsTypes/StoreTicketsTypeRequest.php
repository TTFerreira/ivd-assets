<?php

namespace App\Http\Requests\TicketsTypes;

use App\Http\Requests\Request;

class StoreTicketsTypeRequest extends Request
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
        'type' => 'required|unique:tickets_types,type'
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
        'type.required' => 'You must enter a Type',
        'type.unique' => 'Type \'' . $this->type . '\' already exists. You must enter a unique Type.',
      ];
    }
}
