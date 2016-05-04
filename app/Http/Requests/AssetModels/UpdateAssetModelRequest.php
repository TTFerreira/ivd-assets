<?php

namespace App\Http\Requests\AssetModels;

use App\Http\Requests\Request;

class UpdateAssetModelRequest extends Request
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
          'asset_type_id' => 'required',
          'manufacturer_id' => 'required',
          'asset_model' => 'required'
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
        'asset_type_id.required' => 'You must select the Asset Type.',
        'manufacturer_id.required' => 'You must select the Manufacturer.',
        'asset_model.required' => 'You must enter the Model Name.',
      ];
    }
}
