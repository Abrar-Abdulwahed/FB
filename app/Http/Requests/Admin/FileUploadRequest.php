<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
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
            'file' => 'required|mimetypes:video/*,audio/*,image/*,!text/html,!text/css,!application/javascript,!application/x-httpd-php',
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimetypes' => 'غير مسموح بادخال هذا النوع من الملفات',
        ];
    }
}
