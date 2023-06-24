<table>
    <thead>
        <tr>
            <th>HAWB</th>
            <th>Shipment Account No</th>
            <th>Shipper_Company</th>
            <th>Shipper_Attn</th>
            <th>Shipper_Add1</th>
            <th>Shipper_Add2</th>
            <th>Shipper_Add3</th>
            <th>Shipper_City</th>
            <th>Shipper_State</th>
            <th>Shipper_Zip/Postal_code</th>
            <th>Shipper_IATA Code</th>
            <th>Shipper_Country Code</th>
            <th>Shipper_Phone</th>
            <th>Sender_reference</th>
            <th>receiver_company</th>
            <th>receiver_attention</th>
            <th>receiver_address_1</th>
            <th>receiver_address_2</th>
            <th>receiver_address_3</th>
            <th>receiver_city</th>
            <th>receiver_state</th>
            <th>receiver_zip</th>
            <th>receiver_country_code</th>
            <th>receiver_phone</th>
            <th>receiver_mobile_fax</th>
            <th>shipment_pieces</th>
            <th>shipment_weight</th>
            <th>shipment value</th>
            <th>Local_product _cd</th>
            <th>contents1</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shipmentPackages as $shipment)
            <tr>
                <td> {{ $shipment->barcode }}</td>
                <td> </td>
                <td>{{ $shipment->senderName }}</td>
                <td>{{ $shipment->senderAttention }}</td>
                <td>{{ $shipment->senderAddress }}</td>
                <td>{{ $shipment->senderAddress2 }}</td>
                <td>{{ $shipment->senderAddress3 }}</td>
                <td>{{ $shipment->senderCity }}</td>
                <td>{{ $shipment->senderState }}</td>
                <td>{{ $shipment->senderZipCode   ? '\'' . $shipment->senderZipCode : null }}</td>
                <td></td>
                <td>{{ $shipment->senderCountry }}</td>
                <td>{{ $shipment->senderMobile ? '\'' . $shipment->senderMobile : null }}</td>
                <td>{{ $shipment->company_name }}</td>
                <td>{{ $shipment->receiverCompany }}</td>
                <td>{{ $shipment->receiverAttention }}</td>
                <td>{{ $shipment->receiverAddress }}</td>
                <td>{{ $shipment->receiverAddress2 }}</td>
                <td>{{ $shipment->receiverAddress3 }}</td>
                <td>{{ $shipment->receiverCity }}</td>
                <td>{{ $shipment->receiverState }}</td>
                <td>{{ $shipment->receiverZipCode ? '\'' . $shipment->receiverZipCode : null }}</td>
                <td>{{ $shipment->receiverCountry }}</td>
                <td>{{ $shipment->receiverTelephone ? '\'' . $shipment->receiverTelephone : null }}</td>
                <td>{{ $shipment->receiverMobile }}</td>
                <td>{{ $shipment->totalPiece }}</td>
                <td>{{ $shipment->total_weight }}</td>
                <td>{{ $shipment->value }}</td>
                <td>{{ $shipment->shipment_type == 1 ? 'P' : 'D' }}</td>
                <td>{{ $shipment->content }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
