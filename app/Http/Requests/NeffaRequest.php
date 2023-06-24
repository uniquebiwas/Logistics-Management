<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NeffaRequest extends FormRequest
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
            'firstRow' => ['required', 'array'],
            'shipperDetails' => ['nullable'],
            'shipmentAccount' => ['nullable'],
            'consigneeDetails' => ['nullable'],
            'consigneeAccount' => ['nullable'],
            'airwayBill' => ['nullable'],
            'agentDetails' => ['nullable'],
            'agentCode' => ['nullable'],
            'agentAccount' => ['nullable'],
            'airportDepartures' => ['nullable'],
            'airportTo' => ['nullable'],
            'carrierRouting' => ['nullable'],
            'carrierTo' => ['nullable'],
            'carrierBy' => ['nullable'],
            'carrierTo2' => ['nullable'],
            'carrierBy2' => ['nullable'],
            'airportDestination' => ['nullable'],
            'requestedFlight' => ['nullable'],
            'requestedDate' => ['nullable'],
            'referenceNumber' => ['nullable'],
            'optionalShippingInformation' => ['nullable'],
            'currency' => ['nullable'],
            'code' => ['nullable'],
            'valppd' => ['nullable'],
            'valcoll' => ['nullable'],
            'otherppd' => ['nullable'],
            'othercoll' => ['nullable'],
            'carriageValue' => ['nullable'],
            'customerValue' => ['nullable'],
            'insuranceAmount' => ['nullable'],
            'handilingInformation' => ['nullable'],
            'sci' => ['nullable'],
            'piecesNumber' => ['nullable'],
            'grossWeight' => ['nullable'],
            'kg' => ['nullable'],
            'rateClass' => ['nullable'],
            'commodity' => ['nullable'],
            'chargeableWeight' => ['nullable'],
            'rate' => ['nullable'],
            'total' => ['nullable'],
            'nature' => ['nullable'],
            'prepaidWeightCharge' => ['nullable'],
            'prepaidValuationCharge' => ['nullable'],
            'prepaidTax' => ['nullable'],
            'prepaidDueAgent' => ['nullable'],
            'prepaidDueCarrier' => ['nullable'],
            'totalPrepaid' => ['nullable'],
            'collectWeightCharge' => ['nullable'],
            'collectValuationCharge' => ['nullable'],
            'collectTax' => ['nullable'],
            'collectDueAgent' => ['nullable'],
            'collectDueCarrier' => ['nullable'],
            'totalCollect' => ['nullable'],
            'currencyConversion' => ['nullable'],
            'ccDestinationCharge' => ['nullable'],
            'destinationCharge' => ['nullable'],
            'totalCollectCharge' => ['nullable'],
            'wholeTotal' => ['nullable'],
            'information' => ['nullable'],
            'bottomCode' => ['nullable'],
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'firstRow' => [
                'first' => $this->first,
                'second' => $this->second,
                'third' => $this->third,
                'fourth' => $this->fourth
            ],
            'airwayBill' => [
                'issuedBy' => $this->issuedBy,
                'accountingInformation' => $this->accountingInformation,
            ],
            'information' => [
                'carrierAgent' => $this->carrierAgent,
                'agent' => $this->agent,
                'otherCharge' => $this->otherCharge
            ],
        ]);
    }
}
