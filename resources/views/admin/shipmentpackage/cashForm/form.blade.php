@extends('layouts.admin')
@section('title', $title)
@section('content')
    @push('styles')
        <style>
            label {
                text-transform: capitalize;
                font-size: 16px !important;
                font-weight: 500;
                line-height: 20px;
                text-align: left;
            }

            ::placeholder {
                /* Chrome, Firefox, Opera, Safari 10.1+ */

                text-transform: capitalize;
                /* Firefox */
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
                    $('.items').remove();

                    var table = document.getElementById("tableId");
                    var tbodyRowCount = table.tBodies[0].rows.length;
                    console.log(tbodyRowCount);

                    // if (tbodyRowCount > 1) {
                    //     document.getElementById('totalPiece').stepUp();

                    // }
                    var piece = document.getElementById('totalPiece').value;

                    var part =
                        `<tr class="items">
                            <td>
                                <input name="piece_number[]"
                                 type="text"
                                  placeholder="Number of Pieces" class="form-control form-control-sm weightfrom" required='true'></td>

                        <td><input name="length[]" placeholder=" Breadth in CM" type="text" class="form-control form-control-sm length" required='true'></td>
                        <td><input name="width[]" placeholder="Width in CM" type="text" class="form-control form-control-sm width" required='true'></td>
                        <td><input name="height[]" placeholder=" Height in CM" type="text" class="form-control form-control-sm height" required='true'></td>
                        <td><input name="weight[]" placeholder=" Weight in KG" type="text" class="form-control form-control-sm weight" required='true'></td>
                        <td class='row-total'></td>
                       <td> <input name="package_description[]" placeholder=" description" type="text"
                                                                class="form-control form-control-sm">
                                                        </td>
                        <td><button type="button" class="btn btn-flat btn-outline-danger btn_remove"><i class="fas fa-trash"></i></button></td>
                        </tr>`;
                    for (var h = tbodyRowCount; h < piece; h++) {
                        // console.log(h);

                        $('#tablebody').append(part);

                    }
                });
                $(document).on('click', '.btn_remove', function() {
                    $(this).closest('tr').remove();
                    document.getElementById('totalPiece').stepDown();

                });
            });


            // $('#volumeTotal').on('click', function() {
            //     var tbl = $('#tablebody');
            //     tbl.find('tr').each(function() {
            //         let total = 1;
            //         $(this).find("input[type=text]:not(.weight)").each(function() {
            //             if (parseFloat($(this).val())) {
            //                 total = total * parseFloat($(this).val())
            //                 // console.log(total);

            //             }
            //             // console.log(total);
            //             // total = total / 5000;
            //             $(this).parent().siblings('.row-total').text(total / 5000)

            //         });
            //     })
            $('#volumeTotal').on('click', function() {
                var tbl = $('#tablebody');
                tbl.find('tr').each(function() {
                    var nopcs = $(this).find("input[type=text].weightfrom").val();
                    var length = $(this).find("input[type=text].length").val();
                    var height = $(this).find("input[type=text].height").val();
                    var breadth = $(this).find("input[type=text].width").val();
                    if (nopcs == '') {
                        var p = 0;
                    } else {
                        var p = parseFloat(nopcs);
                    }
                    if (length == '') {
                        var l = 0;
                    } else {
                        var l = parseFloat(length);
                    }
                    if (height == '') {
                        var h = 0;
                    } else {
                        var h = parseFloat(height);
                    }
                    if (breadth == '') {
                        var b = 0;
                    } else {
                        var b = parseFloat(breadth);
                    }
                    var total = p * l * b * h;
                    $(this).find('.row-total').text(total / 5000);
                    // $(this).find("input[type=text]:not(.weight)").each(function() {
                    //     if (parseFloat($(this).val())) {
                    //         total = total * parseFloat($(this).val())
                    //         // console.log(total);

                    //     }
                    //     // console.log(total);
                    //     // total = total / 5000;
                    //     $(this).parent().siblings('.row-total').text(total / 5000)

                    // });
                })

                let sum = 0;
                $('.row-total').each(function() {
                    row = $(this).text();
                    sum = sum + parseFloat(row);
                })
                var totalWeight = 0;
                var weight = document.getElementsByClassName("weight");
                if (weight.length > 0) {
                    for (var i = 0; i < weight.length; i++) {
                        // alert (weight[i].value);

                        totalWeight = totalWeight + parseFloat(weight[i].value);
                        // console.log(totalWeight);

                    }
                }

                sum = sum;
                var chargeWeight = totalWeight;
                if (sum > totalWeight) {
                    chargeWeight = sum;
                }
                totalWeight = totalWeight;
                $('#finalTotal').html(sum + `cm<sup>3</sup>`)
                $('#total_volume_weight').val(sum);
                $('#total_weight').val(totalWeight);
                $('#total_chargeable_weight').val(chargeWeight);
            });
            $('#airway').on('click', function() {
                $('#airways').val(1);
                $('button').each(function() {
                    $(this).disabled = true;
                })
                $('#shipment_form').submit();

            })
            $('#performa').on('click', function() {
                $('#performas').val(1);
                $('button').each(function() {
                    $(this).disabled = true;
                })
                $('#shipment_form').submit();
            })

            $(document).ready(function() {
                $(".select2").select2();
            })
        </script>
        <script>
            $(document).ready(function() {

                $(document).off('click', '#add_image').on('click', '#add_image', function(e) {
                    $('#dynamic_field').append(
                        `<div class="col-md-9">
                                    <div class="row">
                                         <input type="file" class="" name="images[]">
                                        <br><br>
                                        <button type="button" class="btn btn_remove" style="margin-top: -10px;">
                                            <i class="fas fa-trash nav-icon"></i>
                                            </button>
                                            </div>
                                            </div>`
                    );
                });
                $(document).on('click', '.btn_remove', function() {
                    $(this).closest('div').remove();
                });
            });
        </script>
    @endpush
@section('content')

    <section class="content-header mt-0 pt-0"></section>
    <section class="content create-consigment">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @if ($errors->any())
                                @foreach ($errors as $item)
                                    <div>
                                        <span class="text-danger text-sm">$item</span>
                                    </div>
                                @endforeach
                            @endif
                            <h3 class="card-title mt-2 text-bold">{{ $title }} </h3>
                            @if (!request()->is('nd-admin*'))
                                <div class="card-tools">
                                    <h3 class="btn btn-sm btn-info">{{ @$remaining_request ?? 0 }} Credit Amount</h3>
                                </div>
                            @endif
                            <!-- <div class="card-tools">
                                                                            @livewire('add-customer')
                                                                        </div> -->
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="m-0">
                                    {{ Form::open(['url' => $url, 'files' => true, 'class' => 'form', 'name' => 'shipment_form', 'id' => 'shipment_form', 'onsubmit' => 'return confirm("Are you sure you want to submit this package?")']) }}
                                    @if (@$shipmentPackage_info->id)
                                        @method('put')
                                    @endif
                                    <div class="row col-12">
                                        @livewire('sender',['type'=>'sender','model'=>$shipmentPackage_info])
                                        @livewire('receiver',['type'=>'receiver','receiverId'=>$shipmentPackage_info->receiverId
                                        ?? 0,'model'=>$shipmentPackage_info])
                                    </div>
                                    <h5 class="text-capitalize" style="margin-top:30px;">shipment details</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('service_agent') has-error @enderror">
                                                {{ Form::label('service_agent', 'Service:*', ['class' => 'col-md-4']) }}
                                                {{ Form::select('service_agent', @$serviceAgents, @$shipmentPackage_info->service_agent ?? old('service_agent'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'service_agent', 'placeholder' => 'Select Shipment Agent', 'style' => 'width:80%', 'disabled' => (bool) $shipmentPackage_info->id]) }}
                                                @error('service_agent')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row @error('shipment_type') has-error @enderror">
                                                {{ Form::label('shipment_type', 'type:*', ['class' => 'col-md-4']) }}
                                                {{ Form::select('shipment_type', @$packageTypes, @$shipmentPackage_info->shipment_type ?? old('shipment_type'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'shipment_type', 'placeholder' => 'Select Package Type', 'required' => true, 'style' => 'width:80%']) }}
                                                @error('shipment_type')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                            <div class="form-group row @error('content') has-error @enderror">
                                                {{ Form::label('content', 'contents*', ['class' => 'col-md-4 form-control-sm']) }}
                                                {{ Form::textarea('content', @$shipmentPackage_info->content ?? old('content'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'content', 'placeholder' => 'Description of goods', 'required' => true, 'style' => 'width:80%:']) }}
                                                @error('content')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('currency_type') has-error @enderror">
                                                {{ Form::label('currency_type', 'Currency*', ['class' => 'col-md-4']) }}
                                                {!! Form::text('currency_type', $shipmentPackage_info->currency_type ?? old('currency_type'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'currency_type', 'style' => 'width:80%', 'placeholder' => 'USD']) !!}
                                                @error('currency_type')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                {{ Form::label('value', 'Invoice value*', ['class' => 'col-md-4', 'style' => 'text-align:left']) }}
                                                {!! Form::number('value', $shipmentPackage_info->value, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Declared value of custom', 'required']) !!}
                                                @error('value')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            <!-- <div class="form-group row @error('value') has-error @enderror">
                                                                                            {{ Form::label('value', 'Invoice value*', ['class' => 'col-md-4']) }}
                                                                                            {!! Form::number('value', $shipmentPackage_info->value, ['class' => 'form-control form-control-sm col-md-6']) !!}
                                                                                            @error('value')
                                                                                                                                            <span class="help-block error"><small>{{ $message }}</small></span>
                                                                                            @enderror
                                                                                        </div> -->
                                            <div class="form-group row @error('totalPiece') has-error @enderror">
                                                {{ Form::label('totalPiece', 'Total Pieces*', ['class' => 'col-md-4']) }}
                                                {!! Form::number('totalPiece', $shipmentPackage_info->totalPiece, ['class' => 'form-control form-control-sm col-md-4', 'id' => 'totalPiece', 'value' => '1']) !!}
                                                {{ Form::button("<i class='fas fa-plus'></i> Add Item", ['id' => 'add', 'class' => 'btn btn-sm btn-secondary btn-flat mr-2', 'type' => 'button']) }}

                                                @error('totalPiece')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                            {{-- <div class="form-group row @error('payment_type') has-error @enderror">
                                                {{ Form::label('payment_type', 'Payment Type:*', ['class' => 'col-md-3']) }}
                                        {{ Form::select('payment_type', ['Prepaid' => 'Prepaid', 'Postpaid' => 'Postpaid'], @$shipmentPackage_info->payment_type ?? old('payment_type'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'payment_type', 'placeholder' => 'Payment Type', 'style' => 'width:80%']) }}
                                        @error('payment_type')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div>
                                    <div class="form-group row @error('payment_method') has-error @enderror">
                                        {{ Form::label('payment_method', 'Payment Method:*', ['class' => 'col-md-3']) }}
                                        {{ Form::select('payment_method', ['Online' => 'Online', 'Offline' => 'Offline'], @$shipmentPackage_info->payment_method ?? old('payment_method'), ['class' => 'form-control form-control-sm col-md-8', 'id' => 'payment_method', 'placeholder' => 'Payment Method', 'style' => 'width:80%']) }}
                                        @error('payment_method')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                        @enderror
                                    </div> --}}

                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group row @error('images') has-error @enderror">

                                        <div class="col-sm-12">

                                            {{ Form::label('images[]', 'Upload Documents', ['class' => '']) }}
                                            {{ Form::button("<i class='fas fa-plus'></i> Add more", ['id' => 'add_image', 'class' => 'btn btn-danger btn-flat btn-sm', 'type' => 'button']) }}

                                            {{ Form::file('images[]', ['class' => ' form-control-file only-upload', 'multiple' => true, 'id' => 'images', 'placeholder' => 'Upload Shipment Package images (Max 4pcs)', 'style' => 'width:90%']) }}
                                            @error('images')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            {{-- {{ dd($shipmentPackage_info) }} --}}
                                            @if (isset($shipmentPackage_info) && @$shipmentPackage_info->image)
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        {!! getEventProgramFileThumb($shipmentPackage_info->image) !!}
                                                    </div>
                                                </div>
                                            @endif


                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group" id="dynamic_field">



                                                @if ($shipmentPackage_info->id)
                                                    @foreach ($allDocuments->shipmentFiles as $documents)
                                                        {!! getEventProgramFileThumb(asset($documents->filepath)) !!}
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="form-group row">
                                            {{ Form::label('', 'Package Items*', ['class' => 'm-title']) }}
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-hover" id="tableId">
                                                    <thead>
                                                        <tr>
                                                            <th>Number of pieces</th>
                                                            <th>Length</th>
                                                            <th>Breadth</th>
                                                            <th>Height</th>
                                                            <th>Weight</th>
                                                            <th>Volumetric total</th>
                                                            <th>Description</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablebody" class="text-center">
                                                        @php
                                                            $sum = 0;
                                                        @endphp
                                                        @if (isset($shipmentPackage_info->id))
                                                            @foreach ($shipmentPackage_info->getItems as $key => $item)

                                                                <tr>
                                                                    <td>
                                                                        <input name="piece_number[]"
                                                                            value="{{ $item->piece_number }}" type="text"
                                                                            placeholder="Number of Pieces"
                                                                            class="form-control form-control-sm weightfrom"
                                                                            required='true'>
                                                                    </td>

                                                                    <td><input name="length[]"
                                                                            value="{{ $item->length }}"
                                                                            placeholder=" Breadth in CM" type="text"
                                                                            class="form-control form-control-sm length"
                                                                            required='true'></td>
                                                                    <td><input name="width[]" value="{{ $item->width }}"
                                                                            placeholder=" Breadth in CM" type="text"
                                                                            class="form-control form-control-sm width"
                                                                            required='true'></td>
                                                                    <td><input name="height[]"
                                                                            value="{{ $item->height }}"
                                                                            placeholder=" Height in CM" type="text"
                                                                            class="form-control form-control-sm height"
                                                                            required='true'></td>
                                                                    <td><input name="weight[]"
                                                                            value="{{ $item->weight }}"
                                                                            placeholder=" Weight in KG" type="text"
                                                                            class="form-control form-control-sm weight"
                                                                            required='true'></td>
                                                                    <td class='row-total'>{{ $item->volume_weight }}</td>
                                                                    <td>
                                                                        <input name="package_description[]"
                                                                            value="{{ $item->description }}"
                                                                            placeholder=" description" type="text"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                    <td><button type="button"
                                                                            class="btn btn-flat btn-outline-danger btn_remove"><i
                                                                                class="fas fa-trash"></i></button></td>
                                                                </tr>
                                                                @php
                                                                    $sum += $item->volume_weight;
                                                                @endphp
                                                            @endforeach

                                                        @else
                                                            <tr>
                                                                <td>
                                                                    <input name="piece_number[]" type="text"
                                                                        placeholder="Number of Pieces"
                                                                        class="form-control form-control-sm weightfrom"
                                                                        required='true'>
                                                                </td>

                                                                <td><input name="length[]" placeholder=" Breadth in CM"
                                                                        type="text"
                                                                        class="form-control form-control-sm length"
                                                                        required='true'></td>
                                                                <td><input name="width[]" placeholder=" Breadth in CM"
                                                                        type="text"
                                                                        class="form-control form-control-sm width"
                                                                        required='true'></td>
                                                                <td><input name="height[]" placeholder=" Height in CM"
                                                                        type="text"
                                                                        class="form-control form-control-sm height"
                                                                        required='true'></td>
                                                                <td><input name="weight[]" placeholder=" Weight in KG"
                                                                        type="text"
                                                                        class="form-control form-control-sm weight"
                                                                        required='true'></td>
                                                                <td class='row-total'></td>
                                                                <td>
                                                                    <input name="package_description[]"
                                                                        placeholder=" description" type="text"
                                                                        class="form-control form-control-sm">
                                                                </td>
                                                                <td><button type="button"
                                                                        class="btn btn-flat btn-outline-danger btn_remove"><i
                                                                            class="fas fa-trash"></i></button></td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td style="border:none;background:transparent;"></td>
                                                            <td style="border:none;background:transparent;"></td>
                                                            <td style="border:none;background:transparent;"></td>
                                                            <td style="border:none;background:transparent;"></td>
                                                            <td style="border:none;background:transparent;"></td>
                                                            <td class="text-right">Total</td>
                                                            <td id="finalTotal" colspan="2">{{ $sum }}
                                                                cm<sup>3</sup></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="col-sm-6 d-flex">
                                                <!-- {{ Form::button("<i class='fas fa-plus'></i> Add More", ['id' => 'add', 'class' => 'btn btn-sm btn-secondary btn-flat mr-2', 'type' => 'button']) }} -->
                                                {{ Form::button("<i class='fas fa-calculator'></i> total", ['id' => 'volumeTotal', 'class' => 'btn btn-sm btn-secondary btn-flat', 'type' => 'button']) }}
                                            </div>

                                        </div>
                                        <div class="row" style="padding:0px 10px;">
                                            <div class="col-md-4">
                                                <div class="form-group row @error('total_weight') has-error @enderror">
                                                    {{ Form::label('total_weight', 'Gross weight*', ['class' => 'form-control-sm']) }}
                                                    {{ Form::text('total_weight', @$shipmentPackage_info->total_weight ?? old('total_weight'), ['class' => 'form-control form-control-sm ', 'id' => 'total_weight', 'placeholder' => 'gross weight', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('total_weight')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div
                                                    class="form-group row @error('total_volume_weight') has-error @enderror">
                                                    {{ Form::label('total_volume_weight', 'volume weight*', ['class' => 'form-control-sm']) }}
                                                    {{ Form::text('total_volume_weight', @$shipmentPackage_info->total_volume_weight ?? old('total_volume_weight'), ['class' => 'form-control form-control-sm ', 'id' => 'total_volume_weight', 'placeholder' => ' volume weight', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('total_volume_weight')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div
                                                    class="form-group row @error('total_chargeable_weight') has-error @enderror">
                                                    {{ Form::label('total_chargeable_weight', 'Chargeable weight*', ['class' => 'form-control-sm']) }}
                                                    {{ Form::text('total_chargeable_weight', @$shipmentPackage_info->total_chargeable_weight ?? old('total_chargeable_weight'), ['class' => 'form-control form-control-sm ', 'id' => 'total_chargeable_weight', 'placeholder' => ' chargeable weight', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('total_chargeable_weight')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <hr />


                                        {!! Form::hidden('airway', null, ['id' => 'airways']) !!}
                                        {!! Form::hidden('performa', null, ['id' => 'performas']) !!}
                                        <div class="form-group row">

                                            <div class="col-sm-12 mb-2">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="accept_terms"
                                                            id="" value="1" required @if (optional($shipmentPackage_info)->accept_terms)
                                                        checked
                                                        @endif>
                                                        <a href="{{ $sitesetting->term_con_link }}"> Accept Terms and
                                                            Conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                {{ Form::button(' Submit', ['class' => 'btn btn-primary btn-sm', 'type' => 'submit']) }}
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                {{ Form::button(' Print Airway Bill', ['class' => 'btn btn-dark btn-sm', 'id' => 'airway', 'type' => 'button', 'value' => '1']) }}
                                                {{ Form::button('Print performa Schema', ['class' => 'btn btn-dark btn-sm', 'id' => 'performa', 'type' => 'button', 'value' => '2']) }}
                                                <a name="" id="" class="btn btn-dark btn-sm" href="{{ '/nd-admin' }}"
                                                    role="button">Home</a>
                                                <button class="btn btn-dark btn-sm" onClick="window.location.reload()">New
                                                    Shipment</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
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
