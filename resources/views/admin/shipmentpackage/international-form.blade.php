@extends('layouts.admin')
@section('title', 'international-manifest')
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
                        'selectedShipment': {{ $selectedShipment }},
                        'manifest': false,
                        'received': true,
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

        })
    </script>
@endpush
@section('content')
    <div class="content schedule">
        <div class="container-fluid">
            <div class="contents-head">
                <h1>International Manifest</h1>
            </div>
            <section class="content">
                @if ($data->id)
                    <form action="{{ route('international-manifest.update', $data->id) }}" method="post">
                        @method('patch')
                    @else
                        <form action="{{ route('international-manifest.store') }}" method="post">
                @endif
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manifestation Details</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="origin">Origin</label>
                                    <input type="text" required id="origin" name="origin" class="form-control"
                                        value="{{ $data->origin ?? 'Kathmandu, Nepal' }}">
                                    @error('origin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="destination">Destination</label>
                                    <input type="text" required id="destination" name="destination" class="form-control"
                                        value="{{ old('destination', $data->destination) }}">
                                    @error('destination')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client">Consignee</label>
                                    <input type="text" id="client" name="client" class="form-control"
                                        value="{{ old('client', $data->client) }}">
                                    @error('client')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="clientLocation">Consignee Address</label>
                                    <input type="text" id="clientLocation" name="clientLocation" class="form-control"
                                        value="{{ old('clientLocation', $data->clientLocation) }}">
                                    @error('clientLocation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="flightNumber">Airlines / Flight No.</label>
                                    <input type="text" required id="flightNumber" name="flightNumber" class="form-control"
                                        value="{{ old('flightNumber', $data->flightNumber) }}">
                                    @error('flightNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Flight Date</label>
                                    <input type="date" required id="date" name="date" class="form-control"
                                        value="{{ old('date', optional($data->date)->format('Y-m-d')) }}">
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="masterAirwayBill">Master Airway Bill (MAWB)</label>
                                    <input type="text" required id="masterAirwayBill" name="masterAirwayBill"
                                        class="form-control"
                                        value="{{ old('masterAirwayBill', $data->masterAirwayBill) }}">
                                    @error('masterAirwayBill')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card row mt-2">
                    <div class="card-header">
                        <div class="card-title">Shipment Package</div>
                    </div>
                    <div class="card-body search-body">
                        <div class="card-tools d-flex">
                            {!! Form::text('searchShipmentKeyword', request()->searchShipmentKeyword, ['class' => 'form-control form-control-sm mr-2', 'placeholder' => 'Keyword', 'title' => 'Search the package details', 'id' => 'searchShipmentKeyword']) !!}
                            {!! Form::date('startDate', request()->startDate, ['class' => 'form-control form-control-sm mr-2', 'placeholder' => 'Start Date', 'title' => 'start Date', 'id' => 'startDate']) !!}
                            {!! Form::date('endDate', request()->endDate, ['class' => 'form-control form-control-sm mr-2', 'placeholder' => 'End Date', 'title' => 'End Date', 'id' => 'endDate']) !!}
                            <button type="button" name="go" class="view-btn" id="searchPackage">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body row col-12">
                        <div class="card-body p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{!! Form::checkbox('checkAll', 1, '', ['id' => 'checkAll']) !!}</th>
                                        <th style="width: 10px">S.n</th>
                                        <th>HAWB</th>
                                        <th>Date</th>
                                        <th>Service Provider</th>
                                        <th>Shipper</th>
                                        <th>Consignee</th>
                                        <th>Pcs</th>
                                        <th>Weight(KGS)</th>
                                    </tr>
                                </thead>
                                @if ($data->id)
                                    <tbody>
                                        @foreach ($data->shipment as $key => $package)
                                            <tr>
                                                <td>
                                                    {!! Form::checkbox('shipmentId[]', $package->id, 'checked') !!}
                                                </td>
                                                <td>{{ $key + 1 }}.</td>
                                                <td>{{ @$package->barcode }}
                                                </td>
                                                <td>{{ @$package->created_at->format('d-M-y') }}
                                                </td>
                                                <td>{{ $package->getServiceAgent->title }}</td>
                                                <td> {{ @$package->senderName }} </td>
                                                <td> {{ @$package->receiverCompany }} </td>
                                                <td>{{ @$package->totalPiece }}</td>
                                                <td>{{ @$package->total_weight }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                                <tbody id="showTheShipment">

                                </tbody>
                                <tfoot>
                                    @error('shipmentId')
                                        <tr>
                                            <td colspan="7" class="text-center text-danger"> {{ $message }}</td>
                                        </tr>
                                    @enderror
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="btn-group">
                        <button type="submit" class="global-btn mr-2">Submit</button>
                        <button type="reset" class="global-btn">Reset</button>
                    </div>
                </div>

                </form>


            </section>
        </div>
    </div>
@endsection
