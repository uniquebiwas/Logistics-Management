<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GspRequest extends FormRequest
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
            'issued_address' => ['nullable'],
            'reference_no' => ['nullable'],
            'exporter_details' => ['nullable'],
            'consignee_details' => ['nullable'],
            'transport' => ['nullable'],
            'official_use' => ['nullable'],
            'declaration_name' => ['nullable'],
            'declaration_title' => ['nullable'],
            'declaration_city' => ['nullable'],
            'item_no' => ['nullable'],
            'package_marks' => ['nullable'],
            'description_of_goods' => ['nullable'],
            'origin' => ['nullable'],
            'gross_weight' => ['nullable'],
            'invoice_data' => ['nullable'],
            'produced_country' => ['nullable'],
            'importing_country' => ['nullable'],
            'exporter_signature' => ['nullable'],
            'export_date' => ['nullable'],

        ];
    }
}
