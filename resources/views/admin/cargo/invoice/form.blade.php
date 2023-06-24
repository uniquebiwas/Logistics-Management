@extends('layouts.admin')
@section('title', 'Invoice Form')

@push('scripts')
    <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#checkAll").on('change', function() {
                if ($("#checkAll").is(':checked'))
                    $('.selectCheckBox').prop('checked', true);
                else {
                    $('.selectCheckBox').prop('checked', false);;
                }
            });

            $('#paymentType').on('change', function() {
                if ($(this).val() == 'cheque') {
                    $('#chequeNumberContainer').removeClass('d-none');
                } else {
                    $('#chequeNumberContainer').addClass('d-none');
                }

            });


            $('#agentId').select2();
            $('#billingReference').select2();
            $('#agentId').on('change', function() {
                agentId = $(this).val();
                $('#agent').val(agentId);
                if (!agentId) {
                    changeCustomerType();
                }
                if (agentId) {
                    $('.customer').attr('readonly', true);
                    axios.post('{{ route('getuserInformation') }}', {
                        'agentId': agentId,
                        _token: "{{ csrf_token() }}",
                    }).
                    then(function(response) {
                            console.log(response.data);
                            $('#customerName').val(response.data.name);
                            $('#customerAccount').val(response.data.accountNumber);
                            $('#address').val(response.data.address);
                            $('#customerVatNumber').val(response.data.vatNumber);
                            $('#telephone').val(response.data.phone);
                        })
                        .catch(function(error) {
                            toastr.error('Error', 'Selected Agent Is Invalid')
                        });
                }
            })
        });

        function changeCustomerType() {
            $('.customer').val('');
            $('.customer').attr('readonly', false);
        }

        $('#billingReference').on('change', function() {
            changeCustomerType();
            text = $(this).find(':selected').text();
            $('#customerName').val(text);
            $('#searchShipmentKeyword').val(text);
        })
    </script>
@endpush
@section('content')
    @php
    $superAdmin = request()
        ->user()
        ->hasAnyRole(['Super Admin']);
    @endphp
    <section class="content-header pt-0"></section>
    <section class="content">
        @php
            $readOnly = $invoice->id ? true : false;
        @endphp
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Invoice Form
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card row mt-2 mr-2">
                                <div class="card-header">
                                    Agent (Customer) A/C
                                </div>
                                <div class="card-body row">
                                    <div class="col-sm-6">
                                        {!! Form::select('agentId', $agentList, $invoice->agentId, ['id' => 'agentId', 'class' => 'form-control select2', 'placeholder' => 'Select For Agent Only', 'disabled' => $readOnly]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card row mt-2 ml-2">
                                <div class="card-header">
                                    Billing A/C
                                </div>
                                <div class="card-body row">
                                    <div class="col-sm-6">
                                        {!! Form::select('billingReference', $uniqueBillingAccount, '', ['id' => 'billingReference', 'class' => 'form-control select2', 'placeholder' => 'Select For Billing Reference Only', 'disabled' => $readOnly]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    @if ($invoice->id)
                        <form action="{{ route('cargo-invoice.update', $invoice->id) }}" method="post">
                            @method('PATCH')
                        @else
                            <form action="{{ route('cargo-invoice.store') }}" method="post">
                    @endif
                    @csrf
                    <input type="hidden" name="agentId" id="agent">
                    <div class="card row mt-2">
                        <div class="card-header">
                            Customer Information
                        </div>
                        <div class="card-body row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="customerName"> Name</label>
                                            {!! Form::text('customerName', old('customerName', $invoice->customerName), ['id' => 'customerName', 'class' => 'form-control form-control-sm customer', 'readonly' => $readOnly, 'placeholder' => 'Customer Name']) !!}
                                            @error('customerName')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="address"> Address</label>
                                            {!! Form::text('address', old('address', $invoice->address), ['id' => 'address', 'class' => 'form-control form-control-sm customer', 'readonly' => $readOnly, 'placeholder' => 'Customer Address', 'required']) !!}

                                            @error('address')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="telephone"> Telephone</label>
                                            {!! Form::text('telephone', old('telephone', $invoice->telephone), ['id' => 'telephone', 'class' => 'form-control form-control-sm customer', 'readonly' => $readOnly, 'placeholder' => 'Customer telephone']) !!}

                                            @error('telephone')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="customerVatNumber">Vat/Pan Number</label>
                                            {!! Form::text('customerVatNumber', old('customerVatNumber', $invoice->customerVatNumber), ['id' => 'customerVatNumber', 'class' => 'form-control form-control-sm customer', 'readonly' => $readOnly, 'placeholder' => 'Customer VAT Number']) !!}

                                            @error('customerVatNumber')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="paymentType">Payment Type</label>
                                            {!! Form::select('paymentType', ['credit' => 'Credit', 'cash' => 'Cash', 'cheque' => 'Cheque'], old('paymentType', $invoice->paymentType), ['class' => 'form-control form-control-sm', 'id' => 'paymentType']) !!}
                                        </div>
                                    </div>

                                    <div class="col-12 d-none" id="chequeNumberContainer">
                                        <label for="chequeNumber">Cheque Number</label>
                                        {!! Form::text('chequeNumber', old('chequeNumber', $invoice->chequeNumber), ['id' => 'chequeNumber', 'class' => 'form-control form-control-sm', 'placeholder' => 'Cheque Number']) !!}

                                        @error('chequeNumber')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12" id="date">
                                        <label for="date">Issued Date</label>
                                        {!! Form::date('date', old('date', $invoice->date), ['id' => 'date', 'class' => 'form-control form-control-sm', 'placeholder' => 'Cheque Number']) !!}
                                        @error('date')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12" id="dueDate">
                                        <label for="dueDate">Due Date</label>
                                        {!! Form::date('dueDate', old('dueDate', $invoice->dueDate), ['id' => 'dueDate', 'class' => 'form-control form-control-sm', 'placeholder' => 'Cheque Number']) !!}
                                        @error('dueDate')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            {!! Form::hidden('customerAccount', old('customerAccount', $invoice->customerAccount), ['id' => 'customerAccount', 'class' => 'form-control form-control-sm customer', 'readonly' => $readOnly, 'placeholder' => 'Customer Account']) !!}
                                            @error('customerAccount')
                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>






                        </div>
                    </div>

                    @include('admin.cargo.invoice.form-extra')


                    <div class="card row mt-2">
                        <div class="card-header">Invoice Details</div>
                        <div class="card-body">
                            <div class="row invoice-details">

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tiaCharge">AWB Fee</label>
                                        {!! Form::Number('tiaCharge', $invoice->tiaCharge, ['id' => 'tiaCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'AWB Fee', 'value' => '5']) !!}
                                        @error('tiaCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="surcharge">Fuel Surcharge</label>
                                        {!! Form::Number('surcharge', old('surcharge', $invoice->surcharge), ['id' => 'surcharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Surcharge']) !!}
                                        @error('surcharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="goodsPickupCharge">Goods Pickup</label>
                                        {!! Form::Number('goodsPickupCharge', old('goodsPickupCharge', $invoice->goodsPickupCharge), ['id' => 'goodsPickupCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Goods  Pickup ']) !!}
                                        @error('goodsPickupCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="shipmentPackageCharge">Shipment Packaging</label>
                                        {!! Form::Number('shipmentPackageCharge', old('shipmentPackageCharge', $invoice->shipmentPackageCharge), ['id' => 'shipmentPackageCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Shipment Packaging']) !!}
                                        @error('shipmentPackageCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="shipmentHandelingCharge">Shipment Handling</label>
                                        {!! Form::Number('shipmentHandelingCharge', old('shipmentHandelingCharge', $invoice->shipmentHandelingCharge), ['id' => 'shipmentHandelingCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Shipment Handeling']) !!}
                                        @error('shipmentHandelingCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="documentationHandlingCharge">Documentation & Handling</label>
                                        {!! Form::Number('documentationHandlingCharge', old('documentationHandlingCharge', $invoice->documentationHandlingCharge), ['id' => 'documentationHandlingCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Documentation & Handling']) !!}
                                        @error('documentationHandlingCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="customClearingCharge">Customs Clearing</label>
                                        {!! Form::Number('customClearingCharge', old('customClearingCharge', $invoice->customClearingCharge), ['id' => 'customClearingCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Custom Clearing']) !!}
                                        @error('customClearingCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cargoLoadingCharge">Cargo Loading</label>
                                        {!! Form::Number('cargoLoadingCharge', old('cargoLoadingCharge', $invoice->cargoLoadingCharge), ['id' => 'cargoLoadingCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Cargo Loading']) !!}
                                        @error('cargoLoadingCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="oversizeCharge">Over Size</label>
                                        {!! Form::Number('oversizeCharge', old('oversizeCharge', $invoice->oversizeCharge), ['id' => 'oversizeCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Over Size ']) !!}
                                        @error('oversizeCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="overweightCharge">Over Weight</label>
                                        {!! Form::Number('overweightCharge', old('overweightCharge', $invoice->overweightCharge), ['id' => 'overweightCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Over Weight ']) !!}
                                        @error('overweightCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="remoteareaDeliveryCharge">Remote Area Delivery</label>
                                        {!! Form::Number('remoteareaDeliveryCharge', old('remoteareaDeliveryCharge', $invoice->remoteareaDeliveryCharge), ['id' => 'remoteareaDeliveryCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Remote Area Delivery ']) !!}
                                        @error('remoteareaDeliveryCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="fumigationCharge">Fumigation</label>
                                        {!! Form::Number('fumigationCharge', old('fumigationCharge', $invoice->fumigationCharge), ['id' => 'fumigationCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Fumigation ']) !!}
                                        @error('fumigationCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="detentionCharge">Detention</label>
                                        {!! Form::Number('detentionCharge', old('detentionCharge', $invoice->detentionCharge), ['id' => 'detentionCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Detention']) !!}
                                        @error('detentionCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="insuranceCharge">Insurance</label>
                                        {!! Form::Number('insuranceCharge', old('insuranceCharge', $invoice->insuranceCharge), ['id' => 'insuranceCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Insurance']) !!}
                                        @error('insuranceCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="demurrage">Demurrage</label>
                                        {!! Form::Number('demurrage', old('demurrage', $invoice->demurrage), ['id' => 'demurrage', 'class' => 'form-control form-control-sm', 'placeholder' => 'Demurrage']) !!}
                                        @error('demurrage')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="remarks">Remarks</label>
                                        {!! Form::textarea('remarks', old('remarks', $invoice->remarks), ['id' => 'remarks', 'rows' => 4, 'class' => 'form-control form-control-sm', 'placeholder' => 'remarks']) !!}
                                        @error('remarks')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <button type="submit" class="global-btn mr-2">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
