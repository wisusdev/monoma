<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'source' => ['required', 'string', 'min:3', 'max:255'],
            'owner' => ['required', 'exists:users,id', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name must not be greater than 255 characters',
            'source.required' => 'Source is required',
            'source.string' => 'Source must be a string',
            'source.min' => 'Source must be at least 3 characters',
            'source.max' => 'Source must not be greater than 255 characters',
            'owner.required' => 'Owner is required',
            'owner.exists' => 'Owner must be a valid user',
            'owner.integer' => 'Owner must be an integer',
        ];
    }
}
