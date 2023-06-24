<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NccRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reference_no' => ['nullable'],
            'exporter_details' => ['nullable'],
            'exporter_registration_no' => ['nullable'],
            'firm_registration_no' => ['nullable'],
            'place_and_data' => ['nullable'],
            'consignee_details' => ['nullable'],
            'transport' => ['nullable'],
            'license_no' => ['nullable'],
            'declaration_name' => ['nullable'],
            'declaration_title' => ['nullable'],
            'declaration_city' => ['nullable'],
            'package_marks' => ['nullable'],
            'description_of_goods' => ['nullable'],
            'value' => ['nullable'],
            'unit' => ['nullable'],
            'quantity' => ['nullable'],
            'currency' => ['nullable'],
            'production' => ['nullable'],
            'invoice_data' => ['nullable'],
            'export_date' => ['nullable'],
            'value_in_words' => ['nullable'],
        ];
    }
}
