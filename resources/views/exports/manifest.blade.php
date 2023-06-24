<html>
    <table>
        <thead>
            <tr>
                <th><b>Date:</b></th>
                <th> {{ $manifest->created_at->format('d-M-y') }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Mawb No:</th>
                <th>{{ $manifest->masterAirwayBill }}</th>
            </tr>
            <tr>
                <th>Origin:</th>
                <th style="text-transform: capitalize">{{$manifest->origin }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Destination:</th>
                <th>{{ $manifest->destination }}</th>
            </tr>
            <tr>
                <th>Shipper:</th>
                <th>{{ config('settings.name') }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Consignee:</th>
                <th>{{ $manifest->client }}</th>
            </tr>
            <tr>
                <th>Airline/Flight No:</th>
                <th>{{ $manifest->flightNumber }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th> Address:</th>
                <th>{{ $manifest->clientLocation }}</th>
            </tr>
            <tr>
                <th>Flight Date:</th>
                <th>{{ $manifest->date->format('d-M-y') }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Manifest No:</th>
                <th>{{ $manifest->manifest_number }}</th>
            </tr>
            <tr>


                <th>MANIFEST</th>


            </tr>
            <tr>
                <th>S.N</th>
                <th>HWAB</th>
                <th>Service</th>
                <th>Shipper</th>
                <th>Consignee</th>
                <th>Pcs</th>
                <th>Weight</th>
                <th>Contents</th>
                <th>Destination</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shipments as $key => $shipment)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $shipment->barcode }}</td>
                    <td>{{ optional($shipment->getServiceAgent)->title }}</td>
                    <td>{{ $shipment->senderName }}</td>
                    <th>{{ $shipment->receiverCompany }}</th>
                    <th>{{ $shipment->totalPiece }}</th>
                    <th>{{ $shipment->total_weight }}</th>
                    <th>{{ $shipment->content }}</th>
                    <th>{{ $shipment->receiverCountry }}</th>
                    <th>{{ $shipment->currency_type . ' ' . $shipment->value }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>

</html>
