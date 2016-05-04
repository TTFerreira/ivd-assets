<?php

namespace App\Http\Requests\Pcspecs;

use App\Http\Requests\Request;

class StorePcspecRequest extends Request
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
        'cpu' => 'required',
        'ram' => 'required',
        'hdd' => 'required'
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
        'cpu.required' => 'You must enter a CPU Model.',
        'ram.required' => 'You must enter a RAM Size.',
        'hdd.required' => 'You must enter a Hard Drive Size.',
      ];
    }
}
