@forelse ($data as $key => $item)
    <tr>
        <td>
            {!! Form::checkbox('shipmentId[]', $item->id, '', ['class' => 'selectCheckBox']) !!}
        </td>
        <td>{{ $key + 1 }}.</td>
        <td>{{ @$item->barcode }}</td>
        <td> {{ @$item->senderAttention }} </td>
        <td> {{ @$item->receiverAttention }} </td>
        <td>{{ @$item->totalPiece }}</td>
        <td>{{ @$item->total_weight }}</td>

    </tr>

    @foreach ($item->getItems as $package)
        @if ($loop->first)
            <tr>
                <th style="border-bottom:none;border-left:none;background:none;"></th>
                <th></th>
                <th> Total Piece</th>
                <th>Dimensions</th>
                <th>weight</th>
            </tr>
        @endif

        <tr class="pkg-table">
            <td style="border-right:none;border-left:none;border-top:none;border-bottom:none;"></td>
            <td>
                {!! Form::checkbox('shipmentItemId[]', $package->id, '', ['class' => 'selectCheckBox']) !!}
            </td>
            <td>{{ $package->piece_number }}</td>
            <td>{{ $package->length . '*' . $package->width . '*' . $package->height }}</td>
            <td>{{ $package->weight }}</td>
        </tr>
    @endforeach
@empty
    <tr>
        <td colspan="8" class="text-center">No Items remained to be shipped</td>
    </tr>
@endforelse
