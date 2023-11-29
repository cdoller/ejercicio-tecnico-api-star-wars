<?php

namespace App\Http\Requests\Ship;

use App\Http\Requests\BaseFormRequest;

class GetCountRequest extends BaseFormRequest
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
            'id' => 'integer|min:1',
            'name' => 'string|max:30',
            'model' => 'string|max:30'
        ];
    }

    public function messages()
    {
        return [
            'page.integer' => 'The id must be a number',
            'page.min' => 'The id dont be 0 or less',
            'name.string' => 'The name input must be a string',
            'name.max' => 'The max number of characters is 30',
            'model.string' => 'The model input must be a string',
            'model.max' => 'The max number of characters is 30',
        ];
    }
}
