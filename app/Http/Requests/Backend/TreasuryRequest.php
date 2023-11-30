<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TreasuryRequest extends FormRequest
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
                        'name'                  => ['required', 'string'],
                        'is_master'             => ['required'],
                        'last_receipt_exchange' => ['required', 'integer', 'min:0'],
                        'last_receipt_collect'  => ['required', 'integer', 'min:0'],
                        'active'                => ['required'],

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name'                  => ['required', 'string'],
                        'is_master'             => ['required'],
                        'last_receipt_exchange' => ['required', 'integer', 'min:0'],
                        'last_receipt_collect'  => ['required', 'integer', 'min:0'],
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
            'name.required'                     => 'اسم الخزنة مطلوب',
            'is_master.required'                => 'نوع الخزنة مطلوب',
            'active.required'                   => 'حالة الخزنة مطلوب',
            'last_receipt_exchange.required'    => 'اخر ايصال صرف مطلوب',
            'last_receipt_exchange.integer'     => 'الرجاء ادخال قيمة رقمية صحيحة فقط',
            'last_receipt_collect.required'     => 'اخر ايصال تحصيل مطلوب',
            'last_receipt_collect.integer'      => 'الرجاء ادخال قيمة رقمية صحيحة فقط',
        ];
    }
}
