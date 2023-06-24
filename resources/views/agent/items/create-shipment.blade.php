@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/shipment.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(".select2").select2();

                $(document).off('click', '#add').on('click', '#add', function(e) {
                    var part =
                        '<tr><td><input name="quantity[]" type="number" placeholder="Item Quantity" class="form-control form-control-sm weightfrom"></td><td><input name="weight[]" type="number" placeholder="Item Weight" class="form-control form-control-sm weightto"></td><td><input name="length[]" placeholder="Item Length" type="number" class="form-control form-control-sm length"></td><td><input name="height[]" placeholder="Item Height" type="number" class="form-control form-control-sm height"></td><td><button type="button" class="btn btn-flat btn-outline-danger btn_remove"><i class="fas fa-trash"></i></button></td></tr>';
                    $('#tablebody').append(part);
                });
                $(document).on('click', '.btn_remove', function() {
                    $(this).closest('tr').remove();
                });
            });
            $('#service_agent').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('shipment.getCountries') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        serviceAgentId: id
                    },
                    success: function(response) {
                        $("#receiver_country").empty();
                        var len = 0;
                        console.log(response);
                        if (response != null) {
                            len = response.length;
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = response['country'][i].id;
                                    var name = response['country'][i].name;
                                    var option = "<option value='" + id + "'>" + name + "</option>";
                                    $("#receiver_country").append(option);
                                }
                            }
                        } else {
                            alert('Error while fetching data');
                        }
                    }
                });
            });
            $(document).ready(function() {
                $(".select2").select2();
            })

        </script>
    @endpush
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mt-2 text-bold">{{ $title }} </h3>
                            <div class="card-tools">
                                <h3 class="btn btn-sm btn-info">{{ @$remaining_request ?? 0 }} Remaining Requests</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="m-0">
                                    {{ Form::open(['url' => $url, 'files' => true, 'class' => 'form', 'name' => 'shipment_form']) }}
                                    @if (@$shipmentInfo)
                                        @method('put')
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('package_name') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('package_name', 'Name of the package:*', ['class' => '']) }}
                                                    {{ Form::text('package_name', @$shipmentInfo->package_name ?? old('package_name'), ['class' => 'form-control form-control-sm', 'id' => 'package_name', 'placeholder' => 'Name of the package', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('package_name')
                                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div
                                                class="form-group row @error('shipment_package_type_id') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('shipment_package_type_id', 'Package Type:*', ['class' => '']) }}
                                                    {{ Form::select('shipment_package_type_id', $packageTypes, @$shipmentInfo->shipment_package_type_id ?? old('shipment_package_type_id'), ['class' => 'form-control form-control-sm', 'id' => 'shipment_package_type_id', 'placeholder' => 'Select Package Type', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('shipment_package_type_id')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('service_agent') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('service_agent', 'Service Agent:*', ['class' => '']) }}
                                                    {{ Form::select('service_agent', @$serviceAgents, @$shipmentInfo->service_agent ?? old('service_agent'), ['class' => 'form-control form-control-sm', 'id' => 'service_agent', 'placeholder' => 'Select Shipment Agent', 'style' => 'width:80%']) }}
                                                    @error('service_agent')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('shipment_type') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('shipment_type', 'Shipment Type:*', ['class' => '']) }}
                                                    {{ Form::select('shipment_type', ['Express Document', 'Express Parcel'], @$shipmentInfo->shipment_type ?? old('shipment_type'), ['class' => 'form-control form-control-sm', 'id' => 'shipment_type', 'placeholder' => 'Select Package Type', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('shipment_type')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_name') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_name', 'Sender Name.:*', ['class' => '']) }}
                                                    {{ Form::text('sender_name', @$shipmentInfo->sender_name ?? old('sender_name'), ['class' => 'form-control form-control-sm', 'id' => 'sender_name', 'placeholder' => 'Sender name.', 'style' => 'width:80%']) }}
                                                    @error('sender_name')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_mobile') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_mobile', 'Sender Mobile No.:*', ['class' => '']) }}
                                                    {{ Form::number('sender_mobile', @$shipmentInfo->sender_mobile ?? old('sender_mobile'), ['class' => 'form-control form-control-sm', 'id' => 'sender_mobile', 'placeholder' => 'Sender Mobile No.', 'style' => 'width:80%']) }}
                                                    @error('sender_mobile')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_email') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_email', 'Sender Email.:*', ['class' => '']) }}
                                                    {{ Form::email('sender_email', @$shipmentInfo->sender_email ?? old('sender_email'), ['class' => 'form-control form-control-sm', 'id' => 'sender_email', 'placeholder' => 'Sender Email.', 'style' => 'width:80%']) }}
                                                    @error('sender_email')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_address') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_address', 'Sender Address.:*', ['class' => '']) }}
                                                    {{ Form::text('sender_address', @$shipmentInfo->sender_address ?? old('sender_address'), ['class' => 'form-control form-control-sm', 'id' => 'sender_address', 'placeholder' => 'Sender Address', 'style' => 'width:80%']) }}
                                                    @error('sender_address')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_city') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_city', 'Sender City.:*', ['class' => '']) }}
                                                    {{ Form::text('sender_city', @$shipmentInfo->sender_city ?? old('sender_area'), ['class' => 'form-control form-control-sm', 'id' => 'sender_city', 'placeholder' => 'Sender City.', 'style' => 'width:80%']) }}
                                                    @error('sender_city')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_state') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_state', 'Sender State/Province.:*', ['class' => '']) }}
                                                    {{ Form::text('sender_state', @$shipmentInfo->sender_state ?? old('sender_state'), ['class' => 'form-control form-control-sm', 'id' => 'sender_state', 'placeholder' => 'Sender State.', 'style' => 'width:80%']) }}
                                                    @error('sender_state')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_country') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_country', 'Sender Country:*', ['class' => '']) }}
                                                    {{ Form::select('sender_country', $countries, @$shipmentInfo->sender_country ?? old('sender_country'), ['class' => 'form-control form-control-sm', 'id' => 'sender_country', 'placeholder' => 'Sender Country', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('sender_country')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('sender_zipcode') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('sender_zipcode', 'Sender Zipcode/ Postal Code:*', ['class' => '']) }}
                                                    {{ Form::number('sender_zipcode', @$shipmentInfo->sender_zipcode ?? old('sender_zipcode'), ['class' => 'form-control form-control-sm', 'id' => 'sender_zipcode', 'placeholder' => 'Sender zipcode', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('sender_zipcode')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_name') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_name', 'Reciever Name:*', ['class' => '']) }}
                                                    {{ Form::text('receiver_name', @$shipmentInfo->receiver_name ?? old('receiver_name'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_name', 'placeholder' => 'Reciever Name', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('receiver_name')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_mobile') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_mobile', 'Receiver Contact No.:*', ['class' => '']) }}
                                                    {{ Form::number('receiver_mobile', @$shipmentInfo->receiver_mobile ?? old('receiver_mobile'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_mobile', 'placeholder' => 'Receiver Contact No.', 'style' => 'width:80%']) }}
                                                    @error('receiver_mobile')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_email') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_email', 'Reciever Email:*', ['class' => '']) }}
                                                    {{ Form::email('receiver_email', @$shipmentInfo->receiver_email ?? old('receiver_email'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_email', 'placeholder' => 'Reciever Email', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('receiver_email')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_address') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_address', 'Receiver Address.:*', ['class' => '']) }}
                                                    {{ Form::text('receiver_address', @$shipmentInfo->receiver_address ?? old('receiver_address'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_address', 'placeholder' => 'Receiver Address.', 'style' => 'width:80%']) }}
                                                    @error('receiver_address')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_city') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_city', 'Receiver City.:*', ['class' => '']) }}
                                                    {{ Form::text('receiver_city', @$shipmentInfo->receiver_city ?? old('receiver_city'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_city', 'placeholder' => 'Receiver City.', 'style' => 'width:80%']) }}
                                                    @error('receiver_city')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_state') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_state', 'Receiver State.:*', ['class' => '']) }}
                                                    {{ Form::text('receiver_state', @$shipmentInfo->receiver_state ?? old('receiver_state'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_state', 'placeholder' => 'Receiver State.', 'style' => 'width:80%']) }}
                                                    @error('receiver_state')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_country') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_country', 'Reciever Country:*', ['class' => '']) }}
                                                    {{ Form::select('receiver_country', [], @$shipmentInfo->receiver_country ?? old('receiver_country'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_country', 'placeholder' => 'Reciever Country', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('receiver_country')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('receiver_zipcode') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('receiver_zipcode', 'Receiver Zipcode/ Postal Code:*', ['class' => '']) }}
                                                    {{ Form::number('receiver_zipcode', @$shipmentInfo->receiver_zipcode ?? old('receiver_zipcode'), ['class' => 'form-control form-control-sm', 'id' => 'receiver_zipcode', 'placeholder' => 'receiver zipcode', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('receiver_zipcode')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('payment_type') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('payment_type', 'Payment Type:*', ['class' => '']) }}
                                                    {{ Form::select('payment_type', ['Prepaid' => 'Prepaid', 'Postpaid' => 'Postpaid'], @$shipmentInfo->payment_type ?? old('payment_type'), ['class' => 'form-control form-control-sm', 'id' => 'payment_type', 'placeholder' => 'Payment Type', 'style' => 'width:80%']) }}
                                                    @error('payment_type')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row @error('payment_method') has-error @enderror">
                                                <div class="col-sm-12">
                                                    {{ Form::label('payment_method', 'Payment Method:*', ['class' => '']) }}
                                                    {{ Form::select('payment_method', ['Online' => 'Online', 'Offline' => 'Offline'], @$shipmentInfo->payment_method ?? old('payment_method'), ['class' => 'form-control form-control-sm', 'id' => 'payment_method', 'placeholder' => 'Payment Method', 'style' => 'width:80%']) }}
                                                    @error('payment_method')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row @error('images') has-error @enderror">

                                        <div class="col-sm-12">
                                            {{ Form::label('images[]', 'Upload Shipment Package images (Max 4pcs) :*', ['class' => '']) }}
                                            {{ Form::file('images[]', ['class' => 'form-control form-control', 'multiple' => true, 'id' => 'images', 'placeholder' => 'Upload Shipment Package images (Max 4pcs)', 'style' => 'width:90%']) }}
                                            @error('images')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            {{-- {{ dd($shipmentInfo) }} --}}
                                            @if (isset($shipmentInfo) && @$shipmentInfo->image)
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        {!! getEventProgramFileThumb($shipmentInfo->image) !!}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('', 'Package Items*', ['class' => '']) }}
                                        <div class="col-sm-12">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Quantity</th>
                                                        <th>Weight</th>
                                                        <th>Length</th>
                                                        <th>Height</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablebody" class="text-center">

                                                    @if (isset($pricing_info))

                                                        @foreach ($pricing_info->getWeightlength as $key => $item)
                                                            <tr>
                                                                <td><input name="quantity[]"
                                                                        value="{{ $item->quantity }}" type="text"
                                                                        placeholder="Weight From (in KGs)"
                                                                        class="form-control weightfrom">
                                                                </td>
                                                                <td><input name="weight[]" value="{{ $item->weight }}"
                                                                        type="text" placeholder="Weight To (in KGs)"
                                                                        class="form-control weightto">
                                                                </td>
                                                                <td><input name="length[]" value="{{ $item->length }}"
                                                                        placeholder="length" type="text"
                                                                        class="form-control length">
                                                                </td>
                                                                <td><input name="length[]" value="{{ $item->length }}"
                                                                        placeholder="Length" type="text"
                                                                        class="form-control length">
                                                                </td>
                                                                <td>
                                                                    @if ($loop->iteration != 1)
                                                                        <button type="button"
                                                                            class="btn btn-flat btn-outline-danger btn_remove"><i
                                                                                class="fas fa-trash"></i></button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td><input name="quantity[]" type="number"
                                                                    placeholder="Item Quantity"
                                                                    class="form-control form-control-sm">
                                                            </td>
                                                            <td><input name="weight[]" type="number"
                                                                    placeholder="Item Weight"
                                                                    class="form-control form-control-sm">
                                                            </td>
                                                            <td><input name="length[]" placeholder="Item Length"
                                                                    type="number" class="form-control form-control-sm"></td>
                                                            <td><input name="height[]" placeholder="Item Height"
                                                                    type="number" class="form-control form-control-sm">
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-2">
                                            {{ Form::button("<i class='fas fa-plus'></i> Add More", ['id' => 'add', 'class' => 'btn btn-sm btn-secondary btn-flat', 'type' => 'button']) }}
                                        </div>
                                    </div>
                                    <div class="form-group row @error('remarks') has-error @enderror">
                                        <div class="col-sm-12">
                                            {{ Form::label('remarks', 'Remarks:*', ['class' => '']) }}
                                            {{ Form::text('remarks', @$shipmentInfo->remarks ?? old('remarks'), ['class' => 'form-control form-control', 'id' => 'remarks', 'placeholder' => 'Remark', 'required' => true, 'style' => 'width:90%']) }}
                                            @error('remarks')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        {{ Form::label('', '', ['class' => 'col-sm-7']) }}
                                        <div class="col-sm-5">
                                            {{ Form::button(' Submit', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
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
