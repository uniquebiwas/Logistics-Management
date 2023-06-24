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

            #shipment_form ::placeholder {
                /* Chrome, Firefox, Opera, Safari 10.1+ */

                text-transform: capitalize;
                color: #bbb;

                /* Firefox */
            }

            .toggle-off {
                left: initial !important;
            }

        </style>
    @endpush
    @push('scripts')
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

        <script src="{{ asset('/custom/shipment.js') }}"></script>
        <script>
            $(document).ready(function() {
                calculateTotal();
                $(".select2").select2();

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
            $('#cash_invoice').on('click', function() {
                $('#cash_invoices').val(1);
                $('button').each(function() {
                    $(this).disabled = true;
                })
                $('#shipment_form').submit();
            })

            $(document).ready(function() {
                $(".select2").select2();
                $('#flagInvoice').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#cash_invoice').removeClass('d-none');
                    } else {
                        $('#cash_invoice').addClass('d-none');

                    }
                })
            })
        </script>
        <script>
            $(document).ready(function() {

                $(document).off('click', '#add_image').on('click', '#add_image', function(e) {
                    $('.test').append(
                        `<div class="col-md-4">
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
        <script>
            function addrow(divName) {
                var optionval = $("#headoption").val();
                var row = $("#tableId tbody tr").length;
                var count = row + 1;
                var limits = 500;
                if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
                else {
                    var newdiv = document.createElement('tr');
                    newdiv = document.createElement("tr");

                    newdiv.innerHTML = `<td><input name="piece_number[]" type="text"
                                                                placeholder="Number of Pieces"
                                                                class="form-control form-control-sm text-right weightfrom" required='true' onchange="calculateTotal(1)" value="1" >

                                                        </td>

                                                        <td>
                                                            <input name="length[]" placeholder="L" type="text"
                                                                class="form-control form-control-sm text-right length" required='true' onchange="calculateTotal(1)">
                                                        </td>
                                                        <td>
                                                            <input name="width[]" placeholder="B" type="text"
                                                                class="form-control form-control-sm text-right width" required='true' onchange="calculateTotal(1)">
                                                        </td>
                                                        <td>
                                                            <input name="height[]" placeholder="H" type="text"
                                                                class="form-control form-control-sm text-right height" required='true' onchange="calculateTotal(1)">
                                                        </td>
                                                        <td>
                                                            <input name="weight[]" placeholder="Weight" type="text"
                                                                class="form-control form-control-sm text-right weight" required='true' onchange="calculateTotal(1)">
                                                        </td>
                                                        <td class='row-vol-total text-right'></td>
                                                        <td  class='chargeable'></td>

                                                        <td>
                                                            <button class="view-btn" type="button" value="Delete"
                                                                onclick="deleteRow(this)"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </td>`;
                    document.getElementById(divName).appendChild(newdiv);
                    count++;


                }
            }


            function deleteRow(e) {
                var t = $("#tableId > tbody > tr").length;
                if (1 == t) alert("There only one row you can't delete.");
                else {
                    var tbl = $('#tablecontent');


                    var a = e.parentNode.parentNode;
                    a.parentNode.removeChild(a);

                }


                calculateTotal()
            }



            function calculateTotal(sl) {
                var tbl = $('#tablecontent');
                var totalPiece = 0;
                var totalChargeable = 0;
                var total;

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
                    total = p * l * b * h;
                    $(this).find('.row-vol-total').text((total / 5000).toFixed(3));
                    totalPiece += p;

                })

                let sum = 0;
                $('.row-vol-total').each(function() {
                    row = $(this).text();
                    sum = sum + parseFloat(row);
                })
                $(".row-vol-total").each(function() {
                    isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
                });

                $("#vol-total").val(sum.toFixed(3, 3));
                var totalWeight = 0;
                var weight = document.getElementsByClassName("weight");
                if (weight.length > 0) {
                    for (var i = 0; i < weight.length; i++) {
                        // alert (weight[i].value);

                        totalWeight = totalWeight + parseFloat(weight[i].value);
                        var vol = total / 5000;
                        var gw = parseFloat(weight[i].value);
                    }
                }

                sum = sum;
                var chargeWeight = totalWeight;
                // if (sum > totalWeight) {
                //     chargeWeight = sum;
                // }
                totalWeight = totalWeight;
                $('#finalTotal').html(sum + `cm<sup>3</sup>`)
                $('#total_volume_weight').val(sum);
                $('#total_weight').val(totalWeight);
                $('#totalPiece').val(totalPiece);
                calculateChargeableWeight();

            }

            function calculateChargeableWeight() {
                var gross = [];
                $('#tablecontent').find('tr').each(function() {
                    var volTotal = $(this).find('.row-vol-total').text();
                    volTotal = parseFloat(volTotal);
                    var grossTotal = $(this).find("input[type=text].weight").val();
                    var greater = (volTotal > grossTotal) ? volTotal : grossTotal;
                    gross.push(parseFloat(greater));
                });
                chargeWeight = gross.reduce((partial_sum, a) => partial_sum + a, 0);
                $('#total_chargeable_weight').val(chargeWeight.toFixed(3)).trigger('change');
            }


            $(document).on("change", '#total_chargeable_weight,#service_agent,#receiverCountryId', function() {
                $('#test').addClass('d-none');
                var data = {
                    _token: "{{ csrf_token() }}",
                    receiver: $('#receiverCountryId').val(),
                    integrator: $('#service_agent').val(),
                    weight: $('#total_chargeable_weight').val(),
                    agentId: $('#agentId').val() != '' ? $('#agentId').val() : 2,
                };
                if (!data.receiver || !data.integrator || !data.weight) {
                    return null;
                }
                $.ajax({
                    method: "POST",
                    url: "{{ route('search-shipment-totalprice') }}",
                    data: JSON.stringify(data),
                    processData: false,
                    contentType: "application/json; charset=utf-8",
                    success: function(res) {
                        if (res.price) {
                            $('#test').removeClass('d-none');
                            $('#axiosPrice').text(`NPR: ${res.price}`);
                        }

                    },
                    error: function(result, status, err) {
                        console.log(result.responseJSON.message);
                    },

                });
            });
        </script>
        <script>
            var changeBillingType = function(text) {
                if (text == 'sender') {
                    senderName = $('#senderName').val();
                    $('#billing_account').val(senderName);
                }

                if (text == 'consignee') {
                    receiverCompany = $('#receiverCompany').val();
                    $('#billing_account').val(receiverCompany);
                }
            }
        </script>

        <script>
            const check = function(value) {
                if (isNaN(value)) {
                    return 0;
                }
                return value.toFixed(2);
            }
            $('#total_chargeable_weight,#tiaCharge').on('change', function() {
                value = $('#total_chargeable_weight').val() * $('#tiaCharge').val();
                value = check(value);
                $('#tiaCharge').siblings(".sibling").html(`<span>NPR : ${value}</span>`);
            })
            $('#handling,#totalPiece').on('change', function() {
                value = $(this).val() * $('#totalPiece').val()
                value = check(value);
                $('#handling').siblings(".sibling").html(`<span>NPR : ${value}</span>`);
            })
            $('#packaging').on('input', function() {
                value = $(this).val();
                value = check(value);
                console.log(value);
                $('#packaging').siblings(".sibling").html(`<span>NPR : ${value}</span>`);
            })

            $('#billing,#total_chargeable_weight').on('change', function() {
                value = $(this).val() * $('#total_chargeable_weight').val();
                value = check(value);
                $('#billing').siblings(".sibling").html(`<span>NPR : ${value}</span>`);
            })
        </script>

        <script>
            const chargeable = function(e) {
                weight = $(this).closest("tr").find(".weight").val();
                vol = $(this).closest("tr").find(".row-vol-total").text();
                $(this).closest("tr").find(".chargeable").text(parseFloat(weight) > parseFloat(vol) ? weight : vol);
            }

            $(document).ready(function() {
                $(document).on('input', '.weight', chargeable);
                $('.weight').trigger('input');

            })
        </script>
    @endpush
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content create-consigment">
        <div class="container-fluid">
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

                </div>
                <div class="card-body">
                    <div class="">
                        {{ Form::open(['url' => $url,'files' => true,'class' => 'form','name' => 'shipment_form','id' => 'shipment_form','onsubmit' => 'return confirm("Are you sure you want to submit this package?")']) }}
                        @if (@$shipmentPackage_info->id)
                            @method('put')
                        @endif
                        <div class="
                        row col-12">
                            @include('admin.shipmentpackage.partials._sender')
                            @include('admin.shipmentpackage.partials._receiver')
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-capitalize" style="margin-top:30px;">Billing Information</h5>

                                <hr>
                                <div class="form-group row @error('billing_account') has-error @enderror">
                                    {{ Form::label('billing_account', 'Billing A/C*', ['class' => 'col-md-4']) }}
                                    @can('create-awb-as-default-admin')
                                        {!! Form::text('billing_account', $shipmentPackage_info->billing_account ?? old('billing_account'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'billing_account', 'style' => 'width:80%', 'placeholder' => 'account holder']) !!}
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-xs view-btn"
                                                onclick="changeBillingType('sender')">s</button>
                                            <button type="button" class="btn btn-xs view-btn"
                                                onclick="changeBillingType('consignee')">c</button>
                                        </div>
                                    @else
                                        {!! Form::text('billing_account', $shipmentPackage_info->billing_account ?? old('billing_account'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'billing_account', 'style' => 'width:80%', 'placeholder' => 'account holder', 'readonly' => true]) !!}
                                    @endcan

                                    @error('billing_account')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                                <div class="form-group row @error('payment_terms') has-error @enderror">
                                    {{ Form::label('payment_terms', 'Payment Terms:*', ['class' => 'col-md-4']) }}
                                    {{ Form::select('payment_terms',['credit' => 'Credit', 'cash' => 'Cash'],@$shipmentPackage_info->payment_terms ?? old('payment_terms'),['class' => 'form-control form-control-sm col-md-6','id' => 'payment_terms','required' => true,'style' => 'width:80%']) }}
                                    @error('payment_terms')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    {{ Form::label('shipmentReference', 'Shipment Reference*', ['class' => 'col-md-4','style' => 'text-align:left']) }}
                                    {!! Form::text('shipmentReference', $shipmentPackage_info->shipmentReference, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Shipement Reference']) !!}
                                    @error('shipmentReference')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-capitalize" style="margin-top:30px;">Description of goods and value</h5>

                                <hr>

                                <div class="form-group row @error('content') has-error @enderror">
                                    {{ Form::label('content', 'Description Of Goods*', ['class' => 'col-md-4 form-control-sm']) }}
                                    {{ Form::textarea('content', @$shipmentPackage_info->content ?? old('content'), ['class' => 'form-control form-control-sm col-md-6','id' => 'content','placeholder' => 'Description of goods','required' => true,'style' => 'width:80%:']) }}
                                    @error('content')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>

                                <div class="form-group row @error('currency_type') has-error @enderror">
                                    {{ Form::label('currency_type', 'Currency*', ['class' => 'col-md-4']) }}
                                    {!! Form::text('currency_type', $shipmentPackage_info->currency_type ?? old('currency_type'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'currency_type', 'style' => 'width:80%', 'placeholder' => 'USD']) !!}
                                    @error('currency_type')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('value', 'Invoice value for customs*', ['class' => 'col-md-4', 'style' => 'text-align:left']) }}
                                    {!! Form::number('value', $shipmentPackage_info->value, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Declared value of custom', 'required']) !!}
                                    @error('value')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="text-capitalize" style="margin-top:30px;">Product Details (Services)</h5>
                                <hr>

                                <div class="form-group row @error('service_agent') has-error @enderror">
                                    {{ Form::label('service_agent', 'Service Provider:*', ['class' => 'col-md-4']) }}
                                    {{ Form::select('service_agent',@$serviceAgents,@$shipmentPackage_info->service_agent ?? old('service_agent'),['class' => 'form-control form-control-sm col-md-6','id' => 'service_agent','placeholder' => $serviceAgents->take(2)->implode(','),'style' => 'width:80%']) }}
                                    @error('service_agent')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                                <div class="form-group row @error('shipment_type') has-error @enderror">
                                    {{ Form::label('shipment_type', 'shipment type:*', ['class' => 'col-md-4']) }}
                                    {{ Form::select('shipment_type',@$packageTypes,@$shipmentPackage_info->shipment_type ?? old('shipment_type'),['class' => 'form-control form-control-sm col-md-6','id' => 'shipment_type','required' => true,'style' => 'width:80%']) }}
                                    @error('shipment_type')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                                <div class="form-group row @error('shipment_type') has-error @enderror">
                                    {{ Form::label('export_type', 'export type:*', ['class' => 'col-md-4']) }}
                                    {{ Form::select('export_type',['Permanent' => 'Permanent', 'Temporary' => 'Temporary', 'Repair/Return' => 'Repair/Return'],@$shipmentPackage_info->export_type ?? old('export_type'),['class' => 'form-control form-control-sm col-md-6','id' => 'export_type','required' => true,'style' => 'width:80%']) }}
                                    @error('export_type')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                                <div class="form-group row @error('shipment_type') has-error @enderror">
                                    {{ Form::label('destination_duties', 'Destination Duties/Taxes:*', ['class' => 'col-md-4']) }}
                                    {{ Form::select('destination_duties',['Receiver' => 'Receiver', 'Shipper' => 'Shipper'],@$shipmentPackage_info->destination_duties ?? old('destination_duties'),['class' => 'form-control form-control-sm col-md-6','id' => 'destination_duties','required' => true,'style' => 'width:80%']) }}
                                    @error('destination_duties')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>



                            </div>
                        </div>
                        <hr>

                        <div class="form-group @error('images') has-error @enderror">
                            <div class="row" style="align-items: center; display: none;">
                                <div class="col-md-4">
                                    {{ Form::label('images[]', 'Upload Documents', ['class' => '', 'style' => 'margin-right:5px;']) }}
                                    {{ Form::button("<i class='fas fa-plus'></i> Add more", ['id' => 'add_image','class' => 'global-btn','type' => 'button']) }}
                                </div>
                                <div class="col-sm-4">

                                    {{ Form::file('images[]', ['class' => ' form-control-file only-upload','multiple' => true,'id' => 'images','placeholder' => 'Upload Shipment Package images (Max 4pcs)','style' => 'width:90%']) }}
                                    @error('images')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                    @if (isset($shipmentPackage_info) && @$shipmentPackage_info->image)
                                        <div class="row">
                                            <div class="col-lg-4">
                                                {!! getEventProgramFileThumb($shipmentPackage_info->image) !!}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">

                                <div class="form-group" id="dynamic_field">
                                    <div class="row test">


                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12">

                                <div class="form-group" id="dynamic_field">
                                    <div class="row ">
                                        @if ($shipmentPackage_info->id)
                                            @foreach ($allDocuments->shipmentFiles as $documents)
                                                <div class="col-2 mb-1">
                                                    <div class="pdf-viewer">
                                                        {!! getEventProgramFileThumb(asset($documents->filepath)) !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                </div>
                            </div>
                            {{-- <hr /> --}}

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="row">
                                        {{ Form::label('', 'Package Items*', ['class' => 'm-title']) }}
                                        <div class="col-12">
                                            <table class="table table-striped table-hover" id="tableId"
                                                style="max-width: 500px;">
                                                <thead>
                                                    <tr>
                                                        <th>Number of <br>pieces</th>
                                                        <th>Length</th>
                                                        <th>Breadth</th>
                                                        <th>Height</th>
                                                        <th>Gross Weight</th>
                                                        <th>Volumetric<br> Weight</th>
                                                        <th>Chargeable<br>Weight</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablecontent" class="text-center">
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
                                                                        class="form-control form-control-sm text-right weightfrom"
                                                                        required='true' onchange="calculateTotal(1)">
                                                                </td>


                                                                <td><input name="length[]" value="{{ $item->length }}"
                                                                        placeholder="L" type="text"
                                                                        class="form-control form-control-sm text-right length"
                                                                        required='true' onchange="calculateTotal(1)">
                                                                </td>
                                                                <td><input name="width[]" value="{{ $item->width }}"
                                                                        placeholder="B" type="text"
                                                                        class="form-control form-control-sm text-right width"
                                                                        required='true' onchange="calculateTotal(1)">
                                                                </td>
                                                                <td><input name="height[]" value="{{ $item->height }}"
                                                                        placeholder="H" type="text"
                                                                        class="form-control form-control-sm text-right height"
                                                                        required='true' onchange="calculateTotal(1)">
                                                                </td>
                                                                <td><input name="weight[]" value="{{ $item->weight }}"
                                                                        placeholder="Weight" type="text"
                                                                        class="form-control form-control-sm text-right weight"
                                                                        required='true' onchange="calculateTotal(1)">
                                                                </td>
                                                                <td class='row-vol-total text-right'>
                                                                    {{ $item->volume_weight }}
                                                                </td>
                                                                <td class='chargeable'></td>
                                                                <td>
                                                                    <button class="view-btn" type="button"
                                                                        value="Delete" onclick="deleteRow(this)"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $sum += $item->volume_weight;
                                                            @endphp
                                                        @endforeach
                                                    @elseif (old('piece_number'))
                                                        {{-- @dd(old('piece_number'),old('length'),old('width')) --}}
                                                        @foreach (old('piece_number') as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <input name="piece_number[]"
                                                                        value="{{ $item }}" type="text"
                                                                        placeholder="Number of Pieces"
                                                                        class="form-control form-control-sm text-right weightfrom"
                                                                        required='true' oninput="calculateTotal(1)">
                                                                </td>


                                                                <td><input name="length[]"
                                                                        value="{{ old('length.' . $key) }}"
                                                                        placeholder="L" type="text"
                                                                        class="form-control form-control-sm text-right length"
                                                                        required='true' oninput="calculateTotal(1)">
                                                                </td>
                                                                <td><input name="width[]"
                                                                        value="{{ old('width.' . $key) }}"
                                                                        placeholder="B" type="text"
                                                                        class="form-control form-control-sm text-right width"
                                                                        required='true' oninput="calculateTotal(1)">
                                                                </td>
                                                                <td><input name="height[]"
                                                                        value="{{ old('height.' . $key) }}"
                                                                        placeholder="H" type="text"
                                                                        class="form-control form-control-sm text-right height"
                                                                        required='true' oninput="calculateTotal(1)">
                                                                </td>
                                                                <td><input name="weight[]"
                                                                        value="{{ old('weight.' . $key) }}"
                                                                        placeholder="Weight" type="text"
                                                                        class="form-control form-control-sm text-right weight"
                                                                        required='true' oninput="calculateTotal(1)">
                                                                </td>
                                                                <td class='row-vol-total text-right'></td>
                                                                <td class='chargeable'></td>
                                                                <td>
                                                                    <button class="view-btn" type="button"
                                                                        value="Delete" onclick="deleteRow(this)"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    @else
                                                        <tr>
                                                            <td>
                                                                <input name="piece_number[]" type="text"
                                                                    placeholder="Number of Pieces"
                                                                    class="form-control form-control-sm text-right weightfrom"
                                                                    required='true' onchange="calculateTotal(1)" value="1">

                                                            </td>

                                                            <td>
                                                                <input name="length[]" placeholder="L" type="text"
                                                                    class="form-control form-control-sm text-right length"
                                                                    required='true' onchange="calculateTotal(1)">
                                                            </td>
                                                            <td>
                                                                <input name="width[]" placeholder="B" type="text"
                                                                    class="form-control form-control-sm text-right width"
                                                                    required='true' onchange="calculateTotal(1)">
                                                            </td>
                                                            <td>
                                                                <input name="height[]" placeholder="H" type="text"
                                                                    class="form-control form-control-sm text-right height"
                                                                    required='true' onchange="calculateTotal(1)">
                                                            </td>
                                                            <td>
                                                                <input name="weight[]" placeholder="Weight" type="text"
                                                                    class="form-control form-control-sm text-right weight"
                                                                    required='true' onchange="calculateTotal(1)">
                                                            </td>
                                                            <td class='row-vol-total text-right'></td>

                                                            <td class='chargeable'></td>
                                                            <td>
                                                                <button class="view-btn" type="button" value="Delete"
                                                                    onclick="deleteRow(this)"><i
                                                                        class="fas fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>

                                                        <td style="border:none;background:transparent;" colspan="3">
                                                            <div class="form-group row @error('totalPiece') has-error @enderror"
                                                                style="align-items: center;">
                                                                {{ Form::label('totalPiece', 'Total Pieces*', ['class' => 'form-control-sm col-md-6 text-left']) }}
                                                                {{ Form::text('totalPiece', @$shipmentPackage_info->totalPiece ?? old('totalPiece'), [
                                                                    'class' => 'form-control form-control-sm col-md-4 text-left',
                                                                    'id' => 'totalPiece',
                                                                    'placeholder' => 'gross weight',
                                                                    'required' => true,
                                                                    'style' => 'width:80%',
                                                                    request()->user()->hasAnyRole(['Super Admin'])
                                                                        ? ''
                                                                        : 'readonly',
                                                                ]) }}
                                                                @error('totalPiece')
                                                                    <span
                                                                        class="help-block error"><small>{{ $message }}</small></span>
                                                                @enderror
                                                            </div>
                                                        </td>

                                                        <td class="text-right">Total</td>
                                                        <td class="text-right">
                                                            <input type="text" id="total_weight"
                                                                class="form-control form-control-sm text-right"
                                                                name="total_weight"
                                                                value="{{ @$shipmentPackage_info->total_weight }}"
                                                                {{ request()->user()->hasAnyRole(['Super Admin'])
                                                                    ? ''
                                                                    : 'readonly' }} />
                                                        </td>
                                                        <td>
                                                            <input type="text" id="vol-total"
                                                                class="form-control form-control-sm text-right"
                                                                name="total_volume_weight"
                                                                value="{{ @$shipmentPackage_info->total_volume_weight }}"
                                                                {{ request()->user()->hasAnyRole(['Super Admin'])
                                                                    ? ''
                                                                    : 'readonly' }} />
                                                        </td>
                                                        <td>
                                                            {{ Form::text('total_chargeable_weight', @$shipmentPackage_info->total_chargeable_weight ?? old('total_chargeable_weight'), [
                                                                'class' => 'form-control form-control-sm text-right',
                                                                'id' => 'total_chargeable_weight',
                                                                'placeholder' => ' chargeable weight',
                                                                'required' => true,
                                                                request()->user()->hasAnyRole(['Super Admin'])
                                                                    ? ''
                                                                    : 'readonly',
                                                            ]) }}
                                                        </td>

                                                        <td><a id="add_more" class="view-btn" name="add_more"
                                                                onClick="addrow('tablecontent')"><i
                                                                    class="fa fa-plus"></i></a>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row" style="padding:20px 0px 0px 0px ;">


                                                <div class="col-md-6 d-flex justify-content-between">
                                                    <div class="tp-price d-none" id='test'>
                                                        <span class="text-sm text-capitalize">Estimated Shipping
                                                            Charges</span>
                                                        <span id="axiosPrice" class="text-bold"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row" style="padding-top: 30px;">

                                        <div class="col-md-12">
                                            <div class="form-group row @error('tiaCharge') has-error @enderror">
                                                {{ Form::label('tiaCharge', 'TIA Charges', ['class' => 'form-control-sm col-md-4']) }}
                                                {{ Form::text('tiaCharge', @$shipmentCharge->tiaCharge ?? (old('tiaCharge') ?? config('settings.tiaCharge')), [
                                                    'class' => 'form-control form-control-sm col-md-3 text-right',
                                                    'id' => 'tiaCharge',
                                                    'placeholder' => 'tiaCharge',
                                                    request()->user()->hasAnyRole(['Super Admin'])
                                                        ? ''
                                                        : 'readonly',
                                                ]) }}
                                                <div class="col-md-3 sibling">
                                                </div>
                                                @error('tiaCharge')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row @error('handling') has-error @enderror">
                                                {{ Form::label('handling', 'Shipment Handling Charges', ['class' => 'form-control-sm col-md-4']) }}
                                                {{ Form::text('handling', @$shipmentCharge->handling ?? old('handling'), [
                                                    'class' => 'form-control form-control-sm col-md-3 text-right',
                                                    'id' => 'handling',
                                                    'placeholder' => 'handling charge',
                                                    request()->user()->hasAnyRole(['Super Admin'])
                                                        ? ''
                                                        : 'readonly',
                                                ]) }}
                                                <div class="col-md-3 sibling">
                                                </div>
                                                @error('handling')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row @error('packaging') has-error @enderror">
                                                {{ Form::label('packaging', 'Packaging Charges', ['class' => 'form-control-sm col-md-4']) }}
                                                {{ Form::text('packaging', @$shipmentCharge->packaging ?? old('packaging'), [
                                                    'class' => 'form-control form-control-sm col-md-3 text-right',
                                                    'id' => 'packaging',
                                                    'placeholder' => 'packaging charge',
                                                    request()->user()->hasAnyRole(['Super Admin'])
                                                        ? ''
                                                        : 'readonly',
                                                ]) }}
                                                 <div class="col-md-3 sibling">

                                                </div>

                                                @error('packaging')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row @error('billing') has-error @enderror">
                                                {{ Form::label('billing', 'Rate Adjustment', ['class' => 'form-control-sm col-md-4']) }}
                                                {{ Form::text('billing', @$shipmentCharge->billing ?? old('billing'), [
                                                    'class' => 'form-control form-control-sm col-md-3 text-right',
                                                    'id' => 'billing',
                                                    'placeholder' => 'billing charge',
                                                    request()->user()->hasAnyRole(['Super Admin'])
                                                        ? ''
                                                        : 'readonly',
                                                ]) }}
                                                <div class="col-md-3 sibling">
                                                </div>
                                                @error('billing')
                                                    <span class="help-block error"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr />

                            {!! Form::hidden('airway', null, ['id' => 'airways']) !!}
                            {!! Form::hidden('performa', null, ['id' => 'performas']) !!}
                            {!! Form::hidden('cash_invoices', null, ['id' => 'cash_invoices']) !!}
                            <div class="form-group row">
                                <div class="col-sm-12 mb-2">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="accept_terms" id=""
                                                value="1" checked>
                                            <a href="{{ $sitesetting->term_con_link }}"> Accept Terms and
                                                Conditions</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{ Form::button(' Submit', ['class' => 'global-btn', 'type' => 'submit']) }}
                                </div>
                                @hasanyrole('Super Admin|Admin')
                                    <div class="col-md-12 mt-3">
                                        {{ Form::button('Submit And Generate Invoice', ['class' => 'global-btn d-none','id' => 'cash_invoice','type' => 'button','value' => '3']) }}
                                        {{ Form::button('Print AirWay Bill', ['class' => 'global-btn','id' => 'airway','type' => 'button','value' => '1']) }}
                                    </div>
                                @endhasallroles

                            </div>
                            {{ Form::close() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
