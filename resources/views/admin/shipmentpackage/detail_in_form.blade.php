@extends('layouts.admin')
@section('title', $title)
@section('content')
    @push('styles')
        <style>
            label {
                text-transform: capitalize;
                font-size: 14px !important;
                font-weight: 500;
                line-height: 20px;
                text-align: left;
            }

        </style>
    @endpush
    @push('scripts')
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/shipment.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(".select2").select2();

                $(document).off('click', '#add').on('click', '#add', function(e) {
                    var part =
                        `<tr>
                            <td>
                                <input name="piece_number[]"
                                 type="text"
                                  placeholder="piece" class="form-control form-control-sm weightfrom" required='true'></td>
                        <td><input name="weight[]" type="number" placeholder="Item Weight" class="form-control form-control-sm weight" required='true'>
                        </td><td><input name="length[]" placeholder="Item Length" type="number" class="form-control form-control-sm length" required='true'></td>
                        <td><input name="height[]" placeholder="Item Height" type="number" class="form-control form-control-sm height" required='true'></td>
                        <td><input name="width[]" placeholder="Item width" type="number" class="form-control form-control-sm width" required='true'></td>
                        <td class='row-total'></td>
                        <td><button type="button" class="btn btn-flat btn-outline-danger btn_remove"><i class="fas fa-trash"></i></button></td>
                        </tr>`;
                    $('#tablebody').append(part);
                });
                $(document).on('click', '.btn_remove', function() {
                    $(this).closest('tr').remove();
                });
            });


            $('#volumeTotal').on('click', function() {
                var tbl = $('#tablebody');
                tbl.find('tr').each(function() {
                    let total = 1;
                    $(this).find("input[type=number]:not(.weight)").each(function() {
                        if (parseFloat($(this).val())) {
                            total = total * parseFloat($(this).val())
                        }
                        $(this).parent().siblings('.row-total').text(total)

                    });
                })

                let sum = 0;
                $('.row-total').each(function() {
                    row = $(this).text();
                    sum = sum + parseFloat(row);
                })
                sum = sum / 1000000;
                $('#finalTotal').html(sum + `m<sup>3</sup>`)
                $('#total_volume_weight').val(sum);
            });
            $('#airway').on('click', function() {
                $('#airways').val(1);
                $('button').each(function() {
                    $(this).disabled = true;
                })
                $('#shipment_form').submit();

                setTimeout(() => {
                    window.location.reload();
                }, 10000);

            })
            $('#performa').on('click', function() {
                $('#performas').val(1);
                $('#shipment_form').submit();
                window.location.reload();
            })

            $(document).ready(function() {
                $(".select2").select2();
            })
        </script>
    @endpush
@section('content')
    @if ($errors->any())
        @foreach ($errors as $item)
            <div>
                <span class="text-danger text-sm">$item</span>
            </div>
        @endforeach
    @endif
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mt-2 text-bold">{{ $title }} </h3>
                                                       
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="m-0">
                                    
                                    <div class="row col-12">
                                    <div class="col-6 ">
                                        <h5 class="text-capitalize">Sender Information</h5>
                                        <hr>
                                        
                                        <div class="form-group row @error('shipment_date') has-error @enderror">
                                            {{ Form::label('shipment_date', 'Date:*', ['class' => 'col-md-3 form-control-sm']) }}
                                            {!! Form::text('shipment_date', $shipmentPackage_info->shipment_date, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                            @error('shipment_date')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror

                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('account_number', 'account number.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::text('account_number', $shipmentPackage_info->account_number, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('senderName', 'Consignor.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::text('senderName', $sender->name, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('senderAddress', ' Street Name/Number.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::textarea('senderAddress', $sender->address, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('sendercity', ' city.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::text('sender_city', $sender->city, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('senderZipCode', ' Zip Code.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::text('senderZipCode', $sender->zipcode, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('senderCountry', ' Country.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::text('senderCountry', optional($sender->getCountry)->name, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('sender Mobile',  ' Mobile.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::number('senderMobile', $sender->mobile, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('senderEmail', ' Email.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::email('senderEmail', $sender->email, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>

                                        <div class="form-group row">
                                            {{ Form::label('senderState', ' State.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::text('senderState', $sender->state, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('reference_number', ' Reference Number.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                            {!! Form::text('reference_number', $shipmentPackage_info->reference_number, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true,'wire:model'=>'reference_number']) !!}
                                        </div>


                                    </div>

                                    <div class="col-6 ">
                                    <h5 class="text-capitalize">Receiver Information</h5>
                                    <hr>
                                    <div class="form-group row">
                                        {{ Form::label('receiverCode', 'Consignee Code.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::text('receiverCode', $receiver->customerId, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('receiverName', 'Company Name.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::text('receiverName', $receiver->name, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>

                                    <div class="form-group row @error('attention') has-error @enderror">
                                        {{ Form::label('attention', 'attention:*', ['class' => 'col-md-3 form-control-sm']) }}
                                        {{ Form::number('attention', $shipmentPackage_info->attention ?? old('attention'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'attention', 'placeholder' => 'Attention', 'min' => '0', 'max' => '100', 'required' => true, 'style' => 'width:80%', 'disabled' => true]) }}
                                        @error('attention')
                                            <span class="help-block error"><small>{{ $message }}</small></span>
                                        @enderror

                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('receiver_address', ' Street Name/Number.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::textarea('receiver_address', $receiver->address, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('receiver_city', ' city.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::text('receiver_city', $receiver->city, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('receiverZipCode', ' Zip Code.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::text('receiverZipCode', $receiver->zipcode, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('receiverCountry', ' Country.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::text('receiverCountry', optional($receiver->getCountry)->name, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('receiverMobile', ' Mobile.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::number('receiverMobile', $receiver->mobile, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('receiverEmail', ' Email.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::email('receiverEmail', $receiver->email, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>

                                    <div class="form-group row">
                                        {{ Form::label('receiverState', ' State.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                        {!! Form::text('receiverState', $receiver->state, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                    </div>
                                </div>

                                    </div>
                                    <h5 class="text-capitalize">shipment details</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('service_agent') has-error @enderror">
                                                {{ Form::label('service_agent', 'Service:*', ['class' => 'col-md-3']) }}
                                                {{ Form::select('service_agent', @$serviceAgents, @$shipmentPackage_info->service_agent ?? old('service_agent'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'service_agent', 'placeholder' => 'Select Shipment Agent', 'style' => 'width:80%', 'disabled' => (bool) $shipmentPackage_info->id]) }}
                                                @error('service_agent')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row @error('shipment_package_type_id') has-error @enderror">
                                                {{ Form::label('shipment_package_type_id', 'Type:*', ['class' => 'col-md-3']) }}
                                                {{ Form::select('shipment_package_type_id', $packageTypes, @$shipmentPackage_info->shipment_package_type_id ?? old('shipment_package_type_id'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'shipment_package_type_id', 'placeholder' => 'Select Package Type', 'required' => true, 'style' => 'width:80%', 'disabled' => (bool) $shipmentPackage_info->id]) }}
                                                @error('shipment_package_type_id')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row @error('package_name') has-error @enderror">
                                                {{ Form::label('package_name', 'Name of the package:*', ['class' => 'col-md-3 form-control-sm']) }}
                                                {{ Form::text('package_name', @$shipmentPackage_info->package_name ?? old('package_name'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'package_name', 'placeholder' => 'Name of the package', 'required' => true, 'style' => 'width:80%', 'disabled' => true]) }}
                                                @error('package_name')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row @error('shipment_type') has-error @enderror">
                                                {{ Form::label('shipment_type', 'Shipment Item Content:*', ['class' => 'col-md-3']) }}
                                                {{ Form::select('shipment_type', ['Express Document' => 'Express Document', 'Express Parcel' => 'Express Parcel'], @$shipmentPackage_info->shipment_type ?? old('shipment_type'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'shipment_type', 'placeholder' => 'Select Package Type', 'required' => true, 'style' => 'width:80%','disabled' => (bool) $shipmentPackage_info->id]) }}
                                                @error('shipment_type')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('currency_type') has-error @enderror">
                                                {{ Form::label('currency_type', 'Currency:*', ['class' => 'col-md-3']) }}
                                                {{ Form::select('currency_type', $shipmentCharge::CURRENCYTYPE, @$shipmentPackage_info->currency_type ?? old('currency_type'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'currency_type', 'placeholder' => 'currency', 'style' => 'width:80%','disabled' => (bool) $shipmentPackage_info->id]) }}
                                                @error('currency_type')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row @error('total') has-error @enderror">
                                                {{ Form::label('total', 'value:*', ['class' => 'col-md-3']) }}
                                                {!! Form::number('total', $shipmentCharge->total, ['class' => 'form-control form-control-sm col-md-8', 'disabled' => true]) !!}
                                                @error('total')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row @error('payment_type') has-error @enderror">
                                                {{ Form::label('payment_type', 'Payment Type:*', ['class' => 'col-md-3']) }}
                                                {{ Form::select('payment_type', ['Prepaid' => 'Prepaid', 'Postpaid' => 'Postpaid'], @$shipmentPackage_info->payment_type ?? old('payment_type'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'payment_type', 'placeholder' => 'Payment Type', 'style' => 'width:80%','disabled' => (bool) $shipmentPackage_info->id]) }}
                                                @error('payment_type')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row @error('payment_method') has-error @enderror">
                                                {{ Form::label('payment_method', 'Payment Method:*', ['class' => 'col-md-3']) }}
                                                {{ Form::select('payment_method', ['Online' => 'Online', 'Offline' => 'Offline'], @$shipmentPackage_info->payment_method ?? old('payment_method'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'payment_method', 'placeholder' => 'Payment Method', 'style' => 'width:80%','disabled' => (bool) $shipmentPackage_info->id]) }}
                                                @error('payment_method')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <hr>


                                    <div class="form-group row">
                                        {{ Form::label('', 'Package Items*', ['class' => '']) }}
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Piece Number</th>
                                                        <th>Weight</th>
                                                        <th>Length</th>
                                                        <th>Height</th>
                                                        <th>Width</th>
                                                        <th>Volumetric total</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablebody" class="text-center">

                                                    @if (isset($shipmentPackage_info))
                                                        @foreach ($shipmentPackage_info->getItems as $key => $item)
                                                            <tr>
                                                                <td><input name="piece_number[]"
                                                                        value="{{ $item->piece_number }}" type="text"
                                                                        placeholder="Piece Numbers"
                                                                        class="form-control weightfrom" disabled>
                                                                </td>
                                                                <td><input name="weight[]" value="{{ $item->weight }}"
                                                                        type="number" placeholder="Weight To (in KGs)"
                                                                        class="form-control weight" disabled>
                                                                </td>
                                                                <td><input name="length[]" value="{{ $item->length }}"
                                                                        placeholder="length" type="number"
                                                                        class="form-control length" disabled>
                                                                </td>
                                                                <td><input name="height[]" value="{{ $item->height }}"
                                                                        placeholder="Height" type="number"
                                                                        class="form-control height" disabled>
                                                                </td>
                                                                <td><input name="width[]" value="{{ $item->width }}"
                                                                        placeholder="Width" type="number"
                                                                        class="form-control height" disabled>
                                                                </td>
                                                                <td><input name="package_description[]"
                                                                        value="{{ $item->package_description }}"
                                                                        placeholder="Item description" type="text"
                                                                        class="form-control form-control-sm" disabled>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5" class="text-right">Total</td>
                                                        <td id="finalTotal">0</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row @error('total_weight') has-error @enderror">
                                                {{ Form::label('total_weight', 'total weight:*', ['class' => 'form-control-sm']) }}
                                                {{ Form::number('total_weight', @$shipmentPackage_info->total_weight ?? old('total_weight'), ['class' => 'form-control form-control-sm ', 'id' => 'total_weight', 'placeholder' => 'total weight', 'required' => true, 'style' => 'width:80%','disabled' => true]) }}
                                                @error('total_weight')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row @error('total_volume_weight') has-error @enderror">
                                                {{ Form::label('total_volume_weight', 'total volume weight:*', ['class' => 'form-control-sm']) }}
                                                {{ Form::number('total_volume_weight', @$shipmentPackage_info->total_volume_weight ?? old('total_volume_weight'), ['class' => 'form-control form-control-sm ', 'id' => 'total_volume_weight', 'placeholder' => 'total volume weight', 'required' => true, 'style' => 'width:80%', 'disabled' => true]) }}
                                                @error('total_volume_weight')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row @error('total_chargeable_weight') has-error @enderror">
                                                {{ Form::label('total_chargeable_weight', 'total chargeable weight:*', ['class' => 'form-control-sm']) }}
                                                {{ Form::number('total_chargeable_weight', @$shipmentPackage_info->total_chargeable_weight ?? old('total_chargeable_weight'), ['class' => 'form-control form-control-sm ', 'id' => 'total_chargeable_weight', 'placeholder' => 'total chargeable weight', 'required' => true, 'style' => 'width:80%', 'disabled' => true]) }}
                                                @error('total_chargeable_weight')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="form-group row @error('remarks') has-error @enderror">
                                        <div class="col-sm-12">
                                            {{ Form::label('remarks', 'Remarks:*', ['class' => '']) }}
                                            {{ Form::textarea('remarks', @$shipmentPackage_info->remarks ?? old('remarks'), ['class' => 'form-control form-control', 'id' => 'remarks', 'placeholder' => 'Enter Remarks', 'required' => true, 'style' => 'width:90%','disabled' => true]) }}
                                            @error('remarks')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
