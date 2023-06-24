@forelse ($data as $key=>$item)
    <tr>
        <td>
            {!! Form::checkbox('bagId[]', $item->id, '', ['class' => 'selectCheckBox']) !!}
        </td>
        <td>{{ $key + 1 }}</td>
        <td><a href="{{ route('bag.show', $item->id) }}">
                {{ $item->title }}</a></td>
        <td>{{ $item->shipment_count }}</td>
        <td>{{ $item->created_at->toDateTimeString() }}</td>
    </tr>
@empty
    <tr>
        <td colspan="5">No Data Found</td>
    </tr>
@endforelse
