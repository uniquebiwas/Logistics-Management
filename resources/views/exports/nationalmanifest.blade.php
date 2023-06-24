<html>
<table>
    <thead>
       <tr>
        <th>S.n</th>
        <th>HAWB NO</th>
        <th>SHIPPER</th>
        <th>CONSIGNEE</th>
        <th>PIECES</th>
        <th>WEIGHT</th>
        <th>CONTENTS</th>
        <th>DESTINATION</th>
        <th>REMARKS</th>
       </tr>
    </thead>
    <tbody>
        @foreach ($shipments as $key => $shipment)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $shipment->barcode }}</td>
                <td>{{ $shipment->senderName }}</td>
                <th>{{ $shipment->receiverCompany }}</th>
                <th>{{ $shipment->totalPiece }}</th>
                <th>{{ $shipment->total_weight }}</th>
                <th>{{ $shipment->content }}</th>
                <th>{{ $shipment->receiverCountry }}</th>
                <th> {{ $shipment->pivot->remarks }}</th>
            </tr>
        @endforeach
    </tbody>
</table>

</html>
