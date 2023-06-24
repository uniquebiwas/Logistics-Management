<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            // 'customerAccount' => 'required',
            'customerName' => 'required',
            'address' => 'required',
            'dueDate' => 'nullable|date',
            'telephone' => 'nullable',
            'paymentType' => 'required|in:cash,cheque,credit',
            'customerVatNumber' => 'nullable',
            'basicTotal' => 'nullable',
            'fuelCharge' => ['nullable'],
            'tiaCharge' => ['nullable'],
            'customClearingCharge' => ['nullable'],
            'shipmentPackageCharge' => ['nullable'],
            'perPackageCharge' => ['nullable'],
            'insuranceCharge' => ['nullable'],
            'detentionCharge' => ['nullable'],
            'goodsPickupCharge' => ['nullable'],
            'cargoLoadingCharge' => ['nullable'],
            'oversizeCharge' => ['nullable'],
            'overweightCharge' => ['nullable'],
            'remoteareaDeliveryCharge' => ['nullable'],
            'fumigationCharge' => ['nullable'],
            'documentationHandlingCharge' => ['nullable'],
            'shipmentHandelingCharge' => ['nullable'],
            'demurrage' => ['nullable'],
            'roundOff' => ['nullable'],
            'surcharge' => ['nullable'],
            'shipmentId' => 'required',
            'shipmentId.*' => 'required|exists:shipment_packages,id',
            'agentId' => 'nullable',
            'weights' => 'nullable',
            'rates' => 'nullable',
            'remoteAreaDelivery' => 'nullable',
            'particular' => 'nullable',
            'remarks' => 'nullable',
            'date' => 'required|date',
        ];
    }


    public function prepareForValidation()
    {
        $this->merge([
            'customClearingCharge' => $this->customClearingCharge ?? 0,
            'shipmentPackageCharge' => $this->shipmentPackageCharge ?? 0,
            'perPackageCharge' => $this->perPackageCharge ?? 0,
            'insuranceCharge' => $this->insuranceCharge ?? 0,
            'detentionCharge' => $this->detentionCharge ?? 0,
            'goodsPickupCharge' => $this->goodsPickupCharge ?? 0,
            'cargoLoadingCharge' => $this->cargoLoadingCharge ?? 0,
            'fumigationCharge' => $this->fumigationCharge ?? 0,
            'documentationHandlingCharge' => $this->documentationHandlingCharge ?? 0,
            'shipmentHandelingCharge' => $this->shipmentHandelingCharge ?? 0,
            'demurrage' => $this->demurrage ?? 0,
            'date' => request()->date ?? now(),
            'surcharge' => $this->surcharge ?? 0,
            'oversizeCharge' => $this->oversizeCharge ?? 0,
            'overweightCharge' => $this->overweightCharge ?? 0,
            'remoteareaDeliveryCharge' => $this->remoteareaDeliveryCharge ?? 0,
        ]);
    }
}
