<?php

namespace App\Http\Requests\Inventory;

use App\Http\Requests\BaseFormRequest;

class IdRequest extends BaseFormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The id is required',
            'id.integer' => 'The id must be an integer',
            'id.min' => 'The id must be greater than 0',
        ];
    }
}
