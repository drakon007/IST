<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterpretationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "description" => ['required', 'string'],
            "min" => ['required', 'integer'],
            "max" => ['required', 'integer'],
            "column" => ['required', 'string'],
            "degree" => ['required', 'string'],
        ];
    }
}