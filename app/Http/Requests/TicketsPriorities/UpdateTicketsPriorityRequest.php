<?php

namespace App\Http\Requests\TicketsPriorities;

use App\Http\Requests\Request;

class UpdateTicketsPriorityRequest extends Request
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
      $ticketsPriority = $this->route()->parameter('ticketsPriority');

      return [
        'priority' => 'required|unique:tickets_priorities,priority,'.$ticketsPriority->id
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
        'priority.required' => 'You must enter a Priority',
        'priority.unique' => 'Priority \'' . $this->priority . '\' already exists. You must enter a unique Priority.',
      ];
    }
}
