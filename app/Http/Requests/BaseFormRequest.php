<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\JsonValidationException;
use Illuminate\Contracts\Validation\Validator;

class BaseFormRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new JsonValidationException($validator);
    }
}
