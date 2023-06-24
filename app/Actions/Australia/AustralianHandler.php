<?php

namespace App\Actions\Australia;

use App\Http\Resources\IndividualOrderResource;
use App\Models\Agent\ShipmentPackage;
use App\Models\OrderImport;
use Illuminate\Support\Facades\Http;
use PDO;

class AustralianHandler
{
    public $package;
    public $token;

    public function __construct()
    {
        $this->token = 'Gyj6puDBnbcWdhbWBFeEUA==';
    }

    public function getUrl()
    {
        return "http://uatapi.aukwms.com/api";
    }

    public function getServiceAgents()
    {
        return ['1', '2'];
    }

    public function getQuery()
    {
        return   $this->package =  ShipmentPackage::query()->with('orderImport')->whereIn('service_agent', $this->getServiceAgents());
    }

    public function sendOrder($shipment)
    {
        $resultData = Http::withToken($this->token)
            ->post($this->getUrl() . '/import-orders/count/1', [
                'orders' => IndividualOrderResource::collection($shipment),
            ]);

        return    json_decode($resultData->body(), true);
    }

    public function deleteOrder($shipment)
    {
        $responseData =   Http::withToken($this->token)->delete(
            $this->getUrl() . "/remove-order-single",
            [

                "id_order" => $shipment->shipmentId,
                "id_platform" => "1",
                "id_warehouse" => "1"
            ]
        );
        if (!json_decode($responseData->body(), true)['request_success']) {
            return false;
        }
        return true;
    }

    public function quickAllocation($pool_id)
    {
        $quickAllocation =  HTTP::withToken($this->token)
            ->get($this->getUrl() . "/allocation-order/id_pool/$pool_id/type/quick/nocookie/allowNoCookie");
        return $quickAllocation->status();
    }

    public function checkStatus($shipment)
    {
        $responseData  = Http::withToken($this->token)->get($this->getUrl() . "/order-status/id_pool/" . $shipment->pool_id);
        $status  =  json_decode($responseData->body(), true);

        if (!$status['request_success']) {
            return $status['error'];
        }
        return $this->changeStatus($shipment, $status['request_result']['status']);
    }

    private function changeStatus(OrderImport $shipment, $currentStatus)
    {
        return  $shipment->update(['status' => $currentStatus]);
    }

    public function checkLabel($shipment)
    {
        $responseData  = Http::withToken($this->token)->get($this->getUrl() . "/print-label/id_pool/" . $shipment->pool_id);
        $data =  json_decode($responseData->body(), true);
        if (!$responseData) {
            request()->session()->flash('error', 'Api error Occour');
            return redirect()->back();
        }
        return redirect()->to('https://uatapi.aukwms.com' . $data['label']);
    }
}
