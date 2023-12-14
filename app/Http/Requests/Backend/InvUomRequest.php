<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class InvUomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \true;
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
                        'name'                  => ['required', 'string'],
                        'is_master'             => ['required'],
                        'active'                => ['required'],

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name'                  => ['required', 'string'],
                        'is_master'             => ['required'],
                        'active'                => ['required'],
                    ];
                }

            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'                     => 'اسم الحدة مطلوب',
            'is_master.required'                => 'نوع الوحدة مطلوب',
            'active.required'                   => 'حالة الوحدة مطلوب',
        ];
    }
}
