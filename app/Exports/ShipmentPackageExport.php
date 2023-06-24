<?php

namespace App\Exports;

use App\Models\Agent\ShipmentPackage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ShipmentPackageExport  implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $packages;

    public function __construct(array $packages)
    {
        $this->packages = $packages;
    }
    public function query()
    {
        return ShipmentPackage::query()->whereIn('id', $this->packages);
    }

    public function headings(): array
    {
        return [
            'HAWB',
            'Shipment Account No',
            'Shipper_ Company',
            'Shipper_Attn',
            'Shipper_Add1',
            'Shipper_Add2',
            'Shipper_Add3',
            'Shipper_City',
            'Shipper_State',
            'Shipper_Zip/Postal_code',
            'Shipper_IATA Code',
            'Shipper_Country Code',
            'Shipper_Phone',
            'Sender_reference',
            'receiver_company',
            'receiver_attention',
            'receiver_address_1',
            'receiver_address_2',
            'receiver_address_3',
            'receiver_city',
            'receiver_state',
            'receiver_zip',
            'receiver_country_code',
            'receiver_phone',
            'receiver_mobile_fax',
            'shipment_pieces',
            'shipment_weight',
            'shipment value',
            'Local_product _cd',
            'contents1'
        ];
    }
    public function map($shipment): array
    {
        return [
            'HAWB' => $shipment->barcode,
            'Shipment Account No' => '',
            'Shipper_ Company' => $shipment->senderName,
            'Shipper_Attn' => $shipment->senderAttention,
            'Shipper_Add1' => $shipment->senderAddress,
            'Shipper_Add2' => $shipment->senderAddress2,
            'Shipper_Add3' => $shipment->senderAddress3,
            'Shipper_City' => $shipment->senderCity,
            'Shipper_State' => $shipment->senderState,
            'Shipper_Zip/Postal_code' =>  $shipment->senderZipCode,
            'Shipper_IATA Code' => '',
            'Shipper_Country Code' => $shipment->senderCountry,
            'Shipper_Phone' =>   $shipment->senderMobile,
            'Sender_reference' => $this->getAgentCompanyName($shipment->agentId),
            'receiver_company' => $shipment->receiverCompany,
            'receiver_attention' => $shipment->receiverAttention,
            'receiver_address_1' => $shipment->receiverAddress,
            'receiver_address_2' => $shipment->receiverAddress2,
            'receiver_address_3' => $shipment->receiverAddress3,
            'receiver_city' => $shipment->receiverCity,
            'receiver_state' => $shipment->receiverState,
            'receiver_zip' =>  $shipment->receiverZipCode,
            'receiver_country_code' => $shipment->receiverCountry,
            'receiver_phone' =>  $shipment->receiverTelephone,
            'receiver_mobile_fax' => $shipment->receiverMobile,
            'shipment_pieces' => $shipment->totalPiece,
            'shipment_weight' => $shipment->total_weight,
            'shipment value' => $shipment->value,
            'Local_product _cd' => $shipment->shipment_type == 1 ? 'P' : 'D',
            'contents1' => $shipment->content,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'X' => NumberFormat::FORMAT_TEXT
        ];
    }

    public function getAgentCompanyName($userId): string
    {
        return DB::table('agent_profiles')->where('userId', $userId)->value('company_name');
    }
}
