<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'system_name'       => ['required', 'string'],
                        'phone'             => ['required', 'string'],
                        'photo'             => ['nullable', 'string'],
                        'address'           => ['required', 'string'],
                        'general_alert'     => ['nullable', 'string'],
                        'active'            => ['required'],

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'system_name'       => ['required', 'string'],
                        'phone'             => ['required', 'string'],
                        'photo'             => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif', 'size:800'],
                        'address'           => ['required', 'string'],
                        'general_alert'     => ['nullable', 'string'],
                        'active'            => ['required'],
                    ];
                }

            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'system_name.required'       => 'اسم الشركة مطلوب',
            'phone.required'             => 'رقم الهاتف مطلوب',
            'address.required'           => 'عنوان الشركة مطلوب',
        ];
    }
}
