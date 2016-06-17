<?php

namespace App\Http\Requests\Invoices;

use App\Http\Requests\Request;

class StoreInvoiceRequest extends Request
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
        'invoice_number' => 'required|unique:invoices,invoice_number',
        'order_number' => 'required|unique:invoices,order_number',
        'invoiced_date' => 'required',
        'total' => 'required|numeric|between:0, 99999999.99',
        'division_id' => 'required',
        'supplier_id' => 'required',
        'file' => 'mimes:pdf'
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
        'invoice_number.required' => 'You must enter the Invoice Number.',
        'invoice_number.unique' => 'Invoice Number \'' . $this->invoice_number . '\' already exists. You must enter a unique Invoice Number.',
        'order_number.required' => 'You must enter the Order Number.',
        'order_number.unique' => 'Order Number \'' . $this->order_number . '\' already exists. You must enter a unique Order Number.',
        'invoiced_date.required' => 'You must enter the Invoiced Date.',
        'total.required' => 'You must enter the Invoice Total.',
        'total.numeric' => 'You must enter only numbers for the Invoice Total.',
        'total.between:0, 99999999.99' => 'You must enter an amount between 0 and 99999999.99 for the Invoice Total.',
        'division_id.required' => 'You must select the Division.',
        'supplier_id.required' => 'You must select the Supplier.'
      ];
    }
}
