<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TreasuriesDeliveryRequest extends FormRequest
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
            'treasury_can_delivery_id' => ['required', 'integer'],

        ];
    }

    public function messages()
    {
        return [
            'treasury_can_delivery_id.required' => 'اسم الخزنة مطلوب',
            'treasury_can_delivery_id.integer'  => 'نوع البيانات المدخلة غير صحيح ',
        ];
    }
}
