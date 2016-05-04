<?php

namespace App\Http\Requests\TicketsCannedFields;

use App\Http\Requests\Request;

class StoreTicketsCannedFieldRequest extends Request
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
        'user_id' => 'required',
        'location_id' => 'required',
        'ticket_status_id' => 'required',
        'ticket_type_id' => 'required',
        'ticket_priority_id' => 'required',
        'subject' => 'required',
        'description' => 'required'
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
        'user_id.required' => 'You must select an Agent',
        'location_id.required' => 'You must select a Location',
        'ticket_status_id.required' => 'You must select a Ticket Status',
        'ticket_type_id.required' => 'You must select a Ticket Type',
        'ticket_priority_id.required' => 'You must select a Ticket Priority',
        'subject.required' => 'You must enter a Ticket Subject',
        'description.required' => 'You must enter a Ticket Description Message'
      ];
    }
}
