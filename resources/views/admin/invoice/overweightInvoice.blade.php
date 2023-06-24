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
                agentId = $('#agentId').val();
                service_agent = $('#service_agent').val();
                searchShipmentKeyword = $('#searchShipmentKeyword').val();
                if (!startDate || !endDate) {
                    toastr.error('Start Date and End Date are required for search', 'error!')
                    return null;
                }
                axios.post("{{ route('search-shipment-package') }}", {
                        'startDate': startDate,
                        'endDate': endDate,
                        'agentId': agentId,
                        'selectedShipment': {{ $selectedShipment }},
                        'searchShipmentKeyword': searchShipmentKeyword,
                        'service_agent': service_agent,
                        'invoice': true,
                        'rates': true,
                        'weights': true,
                        _token: "{{ csrf_token() }}",
                    })
                    .then(function(response) {
                        $('#showTheShipment').html(response.data);
                    })
                    .catch(function(error) {
                        toastr.error('error!', 'Error Occour')
                    });

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
        $(document).on('input', '.pcs,.weight,.rates', function(e) {
            rate = $(this).closest("tr").find(".rates").val();
            weight = $(this).closest("tr").find(".weight").val();
            pcs = $(this).closest("tr").find(".pcs").val();

            $(this).closest("tr").find(".amounts").val(rate * weight * pcs);
        });

        function getTotal(selector) {
            let totalValue = 0;
            $(selector).each(function() {
                if (this.value !== '') {
                    totalValue += parseFloat(this.value);

                }
            })
            return totalValue;
        }
        setInterval(() => {
            $('#totalPcs').text(getTotal('.pcs'));
            $('#totalWeight').text(getTotal('.weight'));
            $('#totalRate').text(getTotal('.rate'));
            $('#totalAmount').text(getTotal('.amounts'));
        }, 500);
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
                    Reference Number: {{ $invoice->referenceNumber ?? $invoice->invoiceNumber }}
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
                  
                  
                    <form action="{{ route('overpriced-invoice-save', $invoice->id) }}" method="post">
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
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="paymentType">Payment Type</label>
                                                {!! Form::select('paymentType', ['cash' => 'Cash', 'cheque' => 'Cheque', 'credit' => 'Credit'], old('paymentType', $invoice->paymentType), ['class' => 'form-control form-control-sm', 'id' => 'paymentType']) !!}
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

                        @if ($invoice->id)
                            <div class="card row mt-2">
                                <div class="card-header">Previously Selected Shipment</div>
                                <div class="card-body row">
                                    <div class="card-body row col-12">
                                        <div class="card-body p-0">
                                            <table class="table table-bordered table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th style="width: 10px">S.n</th>
                                                        <th>Invoice Type</th>
                                                        <th>HWAB</th>
                                                        <th>Date</th>
                                                        <th>Service Provider</th>
                                                        <th>Shipper</th>
                                                        <th>Consignee</th>
                                                        <th>Pcs</th>
                                                        <th>Weight(KGS)</th>
                                                        <th>Rate</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoice->shipmentPackages as $key => $package)
                                                        <tr>
                                                            <td>
                                                                {!! Form::checkbox('shipmentId[]', $package->id) !!}
                                                            </td>
                                                            <td>{{ $key + 1 }}.</td>
                                                            <td>{!! Form::select('particular[]', $invoice::PARTICULAR, $package->pivot->particular, ['class' => 'form-control']) !!}</td>
                                                            <td>{{ @$package->barcode }}
                                                            </td>
                                                            <td>{{ @$package->created_at->format('d-M-y') }}
                                                            </td>
                                                            <td>{{ $package->getServiceAgent->title }}</td>
                                                            <td> {{ @$package->senderAttention }} </td>
                                                            <td> {{ @$package->receiverAttention }} </td>
                                                            <td>{!! Form::number('', $package->totalPiece, ['class' => 'form-control-sm pcs', 'disabled' => true]) !!}</td>
                                                            <td>{!! Form::text("weights[$package->id]", $package->pivot->weights, ['class' => 'form-control-sm weight']) !!}</td>
                                                            <td>{{ Form::text('amount', $package->pivot->rates / $package->pivot->weights, ['class' => 'form-control-sm rates']) }}
                                                            </td>
                                                            <td>{!! Form::text("rates[$package->id]", $package->pivot->rates, ['class' => 'form-control-sm amounts','readonly']) !!}</td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="8" class="text-right">total</td>
                                                        <td id="totalPcs"></td>
                                                        <td id="totalWeight"></td>
                                                        <td></td>
                                                        <td id="totalAmount"></td>

                                                    </tr>
                                                    @error('shipmentId')
                                                        <tr>
                                                            <td colspan="7" class="text-center text-danger">
                                                                {{ $message }}
                                                            </td>
                                                        </tr>
                                                    @enderror
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                        <div class="card row mt-2">
                            <div class="card-header">Invoice Charge</div>
                            <div class="card-body">
                                <div class="row invoice-details">
                                    @if ($invoice->id)
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tiaCharge">TIA</label>
                                            {!! Form::Number('tiaCharge', 0, ['id' => 'tiaCharge', 'class' => 'form-control form-control-sm', 'placeholder' => 'TIA Surcharge', 'value' => '5']) !!}
                                            @error('tiaCharge')
                                                <small id="helpId"
                                                    class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

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
