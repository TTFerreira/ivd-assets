<?php

namespace App\Http\Requests\Assets;

use App\Http\Requests\Request;

class StoreAssetRequest extends Request
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
          'asset_model_id' => 'required',
          'division_id' => 'required',
          'supplier_id' => 'required',
          'warranty_type_id' => 'required'
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
        'asset_model_id.required' => 'You must select the Model.',
        'division_id.required' => 'You must select the Division.',
        'supplier_id.required' => 'You must select the Supplier.',
        'warranty_type_id.required' => 'You must select the Warranty Type.',
      ];
    }
}
