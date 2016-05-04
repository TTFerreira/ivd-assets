<?php

namespace App\Http\Requests\Budgets;

use App\Http\Requests\Request;

class StoreBudgetRequest extends Request
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
        'division_id' => 'required',
        'year' => 'required',
        'total' => 'required|numeric|between:0, 99999999.99'
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
        'division_id.required' => 'You must select the Division.',
        'year.required' => 'You must enter a Year.',
        'total.required' => 'You must enter the Budget Total.',
        'total.numeric' => 'You must enter only numbers for the Budget Total.',
        'total.between:0, 99999999.99' => 'You must enter an amount between 0 and 99999999.99 for the Budget Total.',
      ];
    }
}
