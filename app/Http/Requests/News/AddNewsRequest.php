<?php

namespace App\Http\Requests\News;

use App\Http\Requests\FormRequest;

class AddNewsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'category_id' => 'required|integer',
        ];
    }
}
