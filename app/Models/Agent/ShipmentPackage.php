<?php

namespace App\Models\Agent;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Load;
use App\Models\LoadShipment;
use App\Models\OrderImport;
use App\Models\ServiceAgent;
use App\Models\ShipmentCancellationReason;
use App\Models\ShipmentCharge;
use App\Models\ShipmentItems;
use App\Models\ShipmentLocation;
use App\Models\ShipmentPackageType;
use App\Models\User;
use App\Models\StatusLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ShipmentPackage extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS = [
        'PENDING',
        'CANCELLED',
        'RECEIVED',
        'MANIFESTED',
        'SCHEDULED',
        'DISPATCHED',
        'IN TRANSIT',
        'ARRIVED AT DUBAI',
        'TRACKING CODE UPDATED',
        'DELIVERED'
    ];

    protected $fillable = [
        'package_name',
        'receiverAttention',
        'content',
        'reference_number',
        'shipment_date',
        'account_number',
        'shipment_type',
        'senderId',
        'receiverId',
        'mwab',
        'barcode',
        'value',
        'remarks',
        'total_weight',
        'total_volume_weight',
        'total_chargeable_weight',
        'package_status',
        'agentId',
        'service_agent',
        'shipment_package_type_id',
        'payment_type',
        'payment_method',
        'shipping_charge',
        'service_charge',
        'service_agent_charge',
        'gov_tax',
        'currency_type',
        'cancellation_reason',
        'cancellation_remarks',
        'cancelled_by_type',
        'cancelled_at',
        'cancelled_by',
        'approved_at',
        'approved_by',
        'received_at',
        'received_by',
        'scheduled_at',
        'scheduled_for',
        'scheduled_by',
        'dispatched_at',
        'dispatched_by',
        'awb_number',
        'tracking_code',
        'flightNumber',
        'airlines',
        'export',
        'accept_terms',
        'totalPiece',
        'manifest',
        'nationalManifest',
        'senderName', 'senderState', 'senderEmail', 'senderAttention',
        'senderMobile', 'senderCountry', 'senderZipCode',
        'senderCity', 'senderAddress3', 'senderAddress2', 'senderAddress',
        'receiverName', 'receiverState', 'receiverEmail',
        'receiverMobile', 'receiverCountry', 'receiverZipCode', 'receiverCity',
        'receiverAddress3', 'receiverAddress2', 'receiverAddress', 'receiverTelephone',
        'receiverConsigneeCode', 'receiverCompany',
        'currency_type',
        'statusId',
        'invoice',
        'receiverCountryId',
        'export_type',
        'destination_duties',
        'created_by',
        'updated_by',
        'payment_terms',
        'billing_account',
        'shipmentReference'
    ];
    protected $casts = [
        'shipment_date' => 'datetime',
        'receiverTelephone' => 'string'
    ];

    protected $with = [
        'getCharge'
    ];

    public function getItems()
    {
        return $this->hasMany(ShipmentItems::class, 'shipmentPackageId', 'id');
    }

    public function getAgent()
    {
        return $this->belongsTo(User::class, 'agentId');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function getSender()
    {
        return $this->hasOne(Customer::class, 'id', 'senderId');
    }

    public function getCharge()
    {
        return $this->hasOne(ShipmentCharge::class, 'shipmentId');
    }

    public function getReceiver()
    {
        return $this->hasOne(Customer::class, 'id', 'receiverId');
    }

    public function getServiceAgent()
    {
        return $this->hasOne(ServiceAgent::class, 'id', 'service_agent');
    }

    public function getPackageType()
    {
        return $this->hasOne(ShipmentPackageType::class, 'id', 'shipment_type');
    }

    public function getDestinationCountry()
    {
        return $this->hasOne(Country::class, 'id', 'receiver_country');
    }

    public function shipmentFiles()
    {
        return $this->hasMany(ShipmentFile::class, 'shipmentId', 'id');
    }

    public function getCancellationBy()
    {
        return $this->hasOne(User::class, 'id', 'cancelled_by');
    }

    public function getCancellationReason()
    {
        return $this->hasOne(ShipmentCancellationReason::class, 'id', 'cancellation_reason');
    }

    public function shipmentLocation()
    {
        return $this->hasMany(ShipmentLocation::class, 'shipmentId');
    }

    public function getStatusLevel()
    {
        return $this->hasOne(StatusLevel::class, 'id', 'statusId');
    }

    public function orderImport()
    {
        return $this->hasOne(OrderImport::class, 'shipmentId');
    }
    public function loads()
    {
        return $this->hasOne(LoadShipment::class, 'shipmentId');
    }
}
