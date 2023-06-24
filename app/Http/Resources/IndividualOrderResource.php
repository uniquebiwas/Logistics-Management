<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndividualOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_order" => $this->getValue($this->id),
            "id_platform" => "1",
            "id_warehouse" => "1",
            "id_sender" => '',
            "sender_info" => [
                "sender_name" => $this->getValue($this->senderName),
                "sender_company" => $this->getValue($this->senderName),
                "sender_address_line1" => $this->getValue($this->senderAddress),
                "sender_address_line2" => $this->getValue($this->senderAddress2),
                "sender_address_suburb" => $this->getValue($this->senderCity),
                "sender_address_city" => $this->getValue($this->senderCity),
                "sender_address_state" => $this->getValue($this->senderCity),
                "sender_address_postcode" => $this->getValue($this->senderZipCode),
                "sender_address_country" => $this->getValue($this->senderCountry),
                "sender_address_country_code" => 'NP',
                "sender_phone" => $this->getValue($this->senderMobile),
                "sender_email" => $this->getValue($this->senderEmail),
            ],
            "receiver_info" => [
                "name" => $this->getValue($this->receiverCompany),
                "company" => $this->getValue($this->receiverCompany),
                "address_line1" => $this->getValue($this->receiverAddress),
                "address_line2" => $this->getValue($this->receiverCity),
                "address_suburb" => $this->getValue($this->receiverCity),
                "address_city" => $this->getValue($this->receiverCity),
                "address_state" =>  $this->getValue($this->receiverState),
                "address_postcode" => $this->getValue($this->receiverZipCode),
                "address_country" => "Australia",
                "address_country_code" => "AU",
                "phone" => $this->getValue($this->receiverMobile),
                "email" => $this->getValue($this->receiverEmail),
                "special_instruction" => ""
            ],
            "shipping_info" => [
                "shipping_method" => "standard post",
                "shipping_total_charge" => "0.00"
            ],
            "platform_info" => [
                "order_reference_id" => "DI319030212MBUUP3AU",
                "payment_total" => 20.25,
                "payment_method" => "prepaid",
                "sales_total" => 20.25
            ],
            "order_items" => $this->getItems->map(fn ($item) => [

                "item_id" => $item->id,
                "item_title" => '',
                "item_sku" => $item->barcode,
                "item_qty" => $item->piece_number,
                "item_unit_price" => '',
                "item_unit_cost" => '',
                "item_image" => '',

            ]),

        ];
    }

    private function getValue($value)
    {
        return $value ?? '';
    }
}
