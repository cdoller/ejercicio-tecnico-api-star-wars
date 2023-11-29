<?php

namespace App\Http\Requests\Ship;

use App\Http\Requests\BaseFormRequest;

class GetShipsRequest extends BaseFormRequest
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
            'page' => 'integer|min:1',
            'search' => 'string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'page.integer' => 'The page number must be a number',
            'page.min' => 'The page number dont be 0 or less',
            'search.string' => 'The search input must be a string',
            'search.max' => 'The max number of characters is 30',
        ];
    }
}
