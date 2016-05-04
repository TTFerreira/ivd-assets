<?php

namespace App\Http\Requests\TicketsStatuses;

use App\Http\Requests\Request;

class UpdateTicketsStatusRequest extends Request
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
      $ticketsStatus = $this->route()->parameter('ticketsStatus');

      return [
        'status' => 'required|unique:tickets_statuses,status,'.$ticketsStatus->id
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
        'status.required' => 'You must enter a Status',
        'status.unique' => 'Status \'' . $this->status . '\' already exists. You must enter a unique Status.',
      ];
    }
}
