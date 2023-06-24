@extends('layouts.admin')
@section('title', 'National Manifest')
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
                        'nationalManifest': true,
                        'remarks': true,
                        'selectedShipment': {{ $selectedShipment }},
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
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold">{{ $nationalManifest->manifestNumber }} Manifest</h3>
                    <div class="card-tools">
                        <a href="{{ route('national-manifest.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($nationalManifest->id)
                        {!! Form::open(['url' => route('national-manifest.update', $nationalManifest->id), 'method' => 'post']) !!}
                        @method('patch')
                    @else
                        {!! Form::open(['url' => route('national-manifest.store'), 'method' => 'post']) !!}
                    @endif
                    @csrf

                    <div class="form-group">
                        <label for="name">Manifest Number</label>
                        {!! Form::text('name', old('name', $nationalManifest->manifestNumber), ['class' => 'form-control form-control-sm', 'id' => 'name', 'required' => 'required', 'readonly']) !!}
                        @error('name')
                            <small id="name" class="text-danger text-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="currencyType">Currency Type</label>
                            {!! Form::text('currencyType', old('currencyType', $nationalManifest->currencyType), ['class' => 'form-control form-control-sm', 'id' => 'currencyType', 'required' => 'required', 'placeholder' => 'USD/EURO']) !!}
                            @error('currencyType')
                                <small id="currencyType" class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="total">Total Value</label>
                            {!! Form::text('total', old('total', $nationalManifest->total), ['class' => 'form-control form-control-sm', 'id' => 'total', 'required' => 'required']) !!}
                            @error('total')
                                <small id="total" class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="card  row mt-2">
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
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    @if ($nationalManifest->id)
                                        <tbody>
                                            @foreach ($nationalManifest->shipment as $key => $package)
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
                                                    <td>{!! Form::text("remarks[$package->id]", $package->pivot->remarks, ['class' => 'form-control-sm']) !!}</td>
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
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
