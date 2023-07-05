<?php

namespace App\Http\Requests\Admin\ShortLink;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShortLinkValidation extends FormRequest
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
            //
            'url' => 'required|url',
            'slug' => ['unique:short_links,slug,' . $this->short_link, 'nullable', 'regex:/^[a-zA-Z0-9]*[a-zA-Z][a-zA-Z0-9]*$/'],
        ];
    }
}
