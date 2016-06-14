<?php

namespace App\Http\Requests\Suppliers;

use App\Http\Requests\Request;

class StoreSupplierRequest extends Request
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
        'name' => 'required|unique:suppliers,name'
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
        'name.required' => 'You must enter a Supplier\'s Name.',
        'name.unique' => '\'' . $this->name . '\' already exists. You must enter a unique Supplier Name.',
      ];
    }
}
