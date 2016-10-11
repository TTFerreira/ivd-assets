<?php

namespace App\Http\Requests\AssetTypes;

use App\Http\Requests\Request;

class StoreAssetTypeRequest extends Request
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
          'type_name' => 'required|unique:asset_types,type_name',
          'abbreviation' => 'required|unique:asset_types,abbreviation',
          'spare' => 'required'
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
        'type_name.required' => 'You must enter the Asset Type Name.',
        'type_name.unique' => 'Asset Type Name \'' . $this->type_name . '\' already exists. You must enter a unique Asset Type Name.',
        'abbreviation.required' => 'You must enter the Abbreviation.',
        'abbreviation.unique' => 'Abbreviation \'' . $this->abbreviation . '\' already exists. You must enter a unique Abbreviation.',
        'spare.required' => 'You must specify if this must be tracked as a spare.',
      ];
    }
}
