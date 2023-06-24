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

            $('#searchPackage').on('click', function() {
                startDate = $('#startDate').val();
                endDate = $('#endDate').val();
                searchShipmentKeyword = $('#searchShipmentKeyword').val();
                if (!startDate || !endDate) {
                    toastr.error('Start Date and End Date are required for search', 'error!')
                    return null;
                }
                axios.post("{{ route('search-shipment-package') }}", {
                        'startDate': startDate,
                        'endDate': endDate,
                        'selectedShipment': {{ request()->shipmentId }},
                        'searchShipmentKeyword': searchShipmentKeyword,
                        _token: "{{ csrf_token() }}",
                    })
                    .then(function(response) {
                        $('#showTheShipment').html(response.data);
                    })
                    .catch(function(error) {
                        toastr.error('error!', 'Error Occour')
                    });

            })
            $('#agentId').select2();
            $('#agentId').on('change', function() {
                agentId = $(this).val();
                if (agentId) {
                    axios.post('{{ route('getuserInformation') }}', {
                        'agentId': agentId,
                        _token: "{{ csrf_token() }}",
                    }).
                    then(function(response) {
                            $('#customerName').val(JSON.parse(response.data.name)['en']);
                            $('#customerAccount').val(response.data.accountNumber);
                            $('#address').val(response.data.address);
                            $('#customerVatNumber').val(response.data.vatNumber);
                        })
                        .catch(function(error) {
                            toastr.error('Error', 'Selected Agent Is Invalid')
                        });
                }
            })
        })
    </script>


@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Invoice Form
                </div>
                <div class="card-body">
                    @if ($invoice->id)
                        <form action="{{ route('invoice.update', $invoice->id) }}" method="post">
                            @method('PATCH')
                        @else
                            <form action="{{ route('invoice.store') }}" method="post">
                    @endif
                    @csrf
                    <div class="card row mt-2">
                        <div class="card-header bg-dark">
                            Customer Information
                        </div>
                        <div class="card-body row">
                            <div class="col-4">
                                <div class="form-group-inline">
                                    <label for="customerName"> Name</label>
                                    {!! Form::text('customerName', old('customerName', $invoice->customerName), ['id' => 'customerName', 'class' => 'form-control form-control-sm', 'placeholder' => 'Customer Name']) !!}

                                    @error('customerName')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group-inline">
                                    <label for="customerAccount"> Account</label>
                                    {!! Form::text('customerAccount', old('customerAccount', $invoice->customerAccount), ['id' => 'customerAccount', 'class' => 'form-control form-control-sm', 'placeholder' => 'Customer Account']) !!}
                                    @error('customerAccount')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group-inline">
                                    <label for="customerVatNumber">Vat/Pan Number</label>
                                    {!! Form::text('customerVatNumber', old('customerVatNumber', $invoice->customerVatNumber), ['id' => 'customerVatNumber', 'class' => 'form-control form-control-sm', 'placeholder' => 'Customer VAT Number']) !!}

                                    @error('customerVatNumber')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group-inline">
                                    <label for="address"> Address</label>
                                    {!! Form::text('address', old('address', $invoice->address), ['id' => 'address', 'class' => 'form-control form-control-sm', 'placeholder' => 'Customer Address']) !!}

                                    @error('address')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="paymentType">Payment Type</label>
                                    {!! Form::select('paymentType', ['cash' => 'cash', 'cheque' => 'cheque', 'credit' => 'credit'], old('paymentType', $invoice->paymentType), ['class' => 'form-control form-control-sm', 'id' => 'paymentType']) !!}
                                </div>
                            </div>

                            <div class="col-4 d-none" id="chequeNumberContainer">
                                <label for="chequeNumber">Cheque Number</label>
                                {!! Form::text('chequeNumber', old('chequeNumber', $invoice->chequeNumber), ['id' => 'chequeNumber', 'class' => 'form-control form-control-sm', 'placeholder' => 'Cheque Number']) !!}

                                @error('chequeNumber')
                                    <small id="helpId" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card row mt-2">
                        <div class="card-header bg-dark col-12">Invoice Information</div>
                        <div class="card-body row">
                            <div class="col-6">
                                <div class="form-group-inline">
                                    <label for="vatNumber">Vat/Pan Number</label>
                                    {!! Form::text('vatNumber', old('vatNumber', $invoice->vatNumber), ['id' => 'vatNumber', 'class' => 'form-control form-control-sm', 'placeholder' => 'Vat Number']) !!}
                                    @error('vatNumber')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group-inline">
                                    <label for="dueDate">Due Date</label>
                                    {!! Form::date('dueDate', old('dueDate', $invoice->dueDate), ['id' => 'dueDate', 'class' => 'form-control form-control-sm', 'placeholder' => 'Vat Number']) !!}
                                    @error('dueDate')
                                        <small id="helpId" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card row mt-2">
                        <div class="card-header bg-dark col-12">Previously Selected Shipment</div>
                        <div class="card-body row">
                            <div class="card-body row col-12">
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="width: 10px">#</th>
                                                <th>Shipment Code</th>
                                                <th>Sender</th>
                                                <th>Receiver</th>
                                                <th>Pcs</th>
                                                <th>Weight(KGS)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shipmentPackages as $key => $package)
                                                <tr>
                                                    <td>
                                                        {!! Form::checkbox('shipmentId[]', $package->id, 'checked', ['readonly' => 'true']) !!}
                                                    </td>
                                                    <td>{{ $key + 1 }}.</td>
                                                    <td>{{ @$package->barcode }} ({{ @$package->package_status }})
                                                    </td>
                                                    <td> {{ @$package->senderAttention }} </td>
                                                    <td> {{ @$package->receiverAttention }} </td>
                                                    <td>{{ @$package->totalPiece }}</td>
                                                    <td>{{ @$package->total_weight }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @error('shipmentId')
                                                <tr>
                                                    <td colspan="7" class="text-center text-danger"> {{ $message }}
                                                    </td>
                                                </tr>
                                            @enderror
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card row mt-2">
                        <div class="card-header col-12 bg-dark">Invoice Charge</div>
                        <div class="card-body row">
                            <div class="offset-md-6"></div>
                            <div class="col-md-6 row">
                                <div class="col-12">
                                    <div class="form-group-inline">
                                        <label for="tiaCharge">TIA charge</label>
                                        {!! Form::Number('tiaCharge', old('tiaCharge', $invoice->tiaCharge), ['id' => 'tiaCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'TIA Surcharge']) !!}
                                        @error('tiaCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group-inline">
                                        <label for="surcharge">Surcharge</label>
                                        {!! Form::Number('surcharge', old('surcharge', $invoice->surcharge), ['id' => 'surcharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'Surcharge']) !!}
                                        @error('surcharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group-inline">
                                        <label for="shipmentPackageCharge">Shipment Package Charge</label>
                                        {!! Form::Number('shipmentPackageCharge', old('shipmentPackageCharge', $invoice->shipmentPackageCharge), ['id' => 'shipmentPackageCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'shipmentPackageCharge']) !!}
                                        @error('shipmentPackageCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group-inline">
                                        <label for="perPackageCharge">Per Package Charge</label>
                                        {!! Form::Number('perPackageCharge', old('perPackageCharge', $invoice->perPackageCharge), ['id' => 'perPackageCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'perPackageCharge']) !!}
                                        @error('perPackageCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group-inline">
                                        <label for="insuranceCharge">Insurance Charge</label>
                                        {!! Form::Number('insuranceCharge', old('insuranceCharge', $invoice->insuranceCharge), ['id' => 'insuranceCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'insuranceCharge']) !!}
                                        @error('insuranceCharge')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
