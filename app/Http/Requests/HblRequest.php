<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HblRequest extends FormRequest
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
            'hblNumber' => ['nullable'],
            'shipmentReferenceNumber' => ['nullable'],
            'shipper' => ['nullable'],
            'consignee' => ['nullable'],
            'notify' => ['nullable'],
            'preCarriageBy' => ['nullable'],
            'transportMode' => ['nullable'],
            'placeOfReceipt' => ['nullable'],
            'portOfLoading' => ['nullable'],
            'portOfDischarge' => ['nullable'],
            'portOfDelivery' => ['nullable'],
            'vesselVoyNumber' => ['nullable'],
            'containerNo' => ['nullable'],
            'marksAndNumbers' => ['nullable'],
            'description' => ['nullable'],
            'grossWeight' => ['nullable'],
            'measurement' => ['nullable'],
            'freightAmount' => ['nullable'],
            'freightPayable' => ['nullable'],
            'numberOfOriginalHbl' => ['nullable'],
            'issueDate' => ['nullable'],
            'others' => ['nullable'],
            'lastPart' => ['nullable'],
            'amountInWords' => ['nullable']
        ];
    }
}
