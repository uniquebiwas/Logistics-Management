@forelse ($data as $key => $item)
    <tr>
        <td>
            {!! Form::checkbox('shipmentId[]', $item->id, '', ['class' => 'selectCheckBox']) !!}
        </td>
        <td>{{ $key + 1 }}.</td>
        @if ($invoiceType)
            <td>
                {!! html_entity_decode(Form::select("particular[$item->id]", $particularType, 1, ['class' => 'form-control'])) !!}
            </td>
        @endif
        <td>{{ @$item->barcode }}</td>
        <td>{{ @$item->created_at->format('d-M-y') }}</td>
        <td>{{ $item->getServiceAgent->title }}</td>
        <td> {{ @$item->senderName }} </td>
        <td> {{ @$item->receiverCompany }} </td>
        <td>{!! Form::text('pcs', $item->totalPiece, ['class' => 'form-control pcs','readonly','style'=>'width:50px']) !!}</td>
        @if (!$weights)
            <td>{{ @$item->total_chargeable_weight }}</td>
        @endif

        @if ($weights)
            <td>{!! Form::text("weights[$item->id]", @$item->total_chargeable_weight, [
    'class' => 'form-control-sm w-120 weights',
    request()->user()->can(['change-weight'])
        ? ''
        : 'readonly',
]) !!}</td>
        @endif

        @if (isset($amounts) && $amounts)
            <td>{!! Form::text('amounts', bcdiv(($item->getCharge->shipping_charge ?? 0), $item->total_chargeable_weight, 2), [
    'class' => 'form-control-sm w-120 rates',
    'step'=>'any',
    request()->user()->can(['change-rate'])
        ? ''
        : 'readonly',
]) !!}</td>
        @endif
        @if ($rates)
            <td>{!! Form::text("rates[$item->id]", @$item->getCharge->shipping_charge ?? 0, [
    'class' => 'form-control-sm w-120 amounts',
    'step'=>'any',
    request()->user()->can(['change-rate'])
        ? ''
        : 'readonly',
]) !!}</td>
        @endif

        @if ($remarks)
            <td>{!! Form::text("remarks[$item->id]", '', ['class' => 'form-control-sm']) !!}</td>
        @endif
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center">No Data Found</td>
    </tr>
@endforelse
