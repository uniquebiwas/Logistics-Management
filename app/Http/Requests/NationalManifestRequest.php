<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NationalManifestRequest extends FormRequest
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
            'total' => 'required|numeric',
            'shipmentId' => 'required|array',
            'shipmentId.*' => 'required|exists:shipment_packages,id',
            'remarks' => 'required|array',
            'remarks.*' => 'nullable|string',
            'currencyType' => 'nullable',
        ];
    }
}
