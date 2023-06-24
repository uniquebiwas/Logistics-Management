<?php

namespace App\Http\Requests;

use App\Models\CargoInvoice;
use Illuminate\Foundation\Http\FormRequest;

class CargoInvoiceRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'date' => ['nullable', 'date'],
            'vatNumber' => ['nullable'],
            'customerAccount' => ['nullable'],
            'telephone' => ['nullable'],
            'customerName' => ['nullable'],
            'address' => ['nullable'],
            'dueDate' => ['nullable'],
            'paymentType' => ['required'],
            'serviceId' => ['nullable'],
            'agentId' => ['nullable'],
            'chequeNumber' => ['nullable'],
            'customerVatNumber' => ['nullable'],
            'basicTotal' => ['nullable'],
            'fuelCharge' => ['nullable'],
            'tiaCharge' => ['nullable'],
            'customClearingCharge' => ['nullable'],
            'shipmentPackageCharge' => ['nullable'],
            'perPackageCharge' => ['nullable'],
            'insuranceCharge' => ['nullable'],
            'detentionCharge' => ['nullable'],
            'goodsPickupCharge' => ['nullable'],
            'cargoLoadingCharge' => ['nullable'],
            'fumigationCharge' => ['nullable'],
            'documentationHandlingCharge' => ['nullable'],
            'shipmentHandelingCharge' => ['nullable'],
            'demurrage' => ['nullable'],
            'roundOff' => ['nullable'],
            'surcharge' => ['nullable'],
            'remarks' => ['nullable'],
            'paymentStatus' => ['nullable'],
            'referenceNumber' => ['nullable'],
            'oversizeCharge' => ['nullable'],
            'overweightCharge' => ['nullable'],
            'particulars' => ['array'],
            'service' => ['array'],
            'awbNumber' => ['array'],
            'awbDate' => ['array'],
            'consignee' => ['array'],
            'destination' => ['array'],
            'pcs' => ['array'],
            'weight' => ['array'],
            'rate' => ['array'],
            'amount' => ['array'],
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
            'tiaCharge' => $this->tiaCharge ??  0,
        ]);
    }
}
