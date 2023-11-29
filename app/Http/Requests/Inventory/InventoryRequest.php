<?php

namespace App\Http\Requests\Inventory;

use App\Http\Requests\BaseFormRequest;

class InventoryRequest extends BaseFormRequest
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
            'id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id.required'       => 'The ID is required',
            'id.integer'        => 'The ID must be a number',
            'id.min'            => 'The ID must be possitive',
            'quantity.required' => 'Quantity of inventory is required',
            'quantity.integer'  => 'Quantity must be an entered number',
            'quantity.min'      => 'Quantity must be a possitive number',
        ];
    }
}
