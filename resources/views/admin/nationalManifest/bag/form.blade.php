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


                axios.post("{{ route('search-invoice') }}", {
                        'startDate': startDate,
                        'endDate': endDate,
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
    <section class="content add-bag">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Baggage</h3>
                    <div class="card-tools">
                        <a href="{{ route('national-manifest.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($bag->id)
                        {!! Form::open(['url' => route('bag.update', $bag->id), 'method' => 'post']) !!}
                        @method('PATCH')
                    @else
                        {!! Form::open(['url' => route('bag.store'), 'method' => 'post']) !!}
                    @endif
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Bag Number</label>
                            {!! Form::text('title', old('title', $bag->title), ['class' => 'form-control form-control-sm', 'id' => 'title', 'required' => 'required']) !!}
                            @error('title')
                                <small id="titleHelp" class="text-danger text-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Shipment Package</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="card-tools d-flex">
                                                {!! Form::text('searchShipmentKeyword', request()->searchShipmentKeyword, ['class' => 'form-control form-control-sm mr-2', 'placeholder' => 'Keyword', 'title' => 'Search the package details', 'id' => 'searchShipmentKeyword']) !!}
                                                {!! Form::date('startDate', request()->startDate, ['class' => 'form-control form-control-sm mr-2', 'placeholder' => 'Start Date', 'title' => 'start Date', 'id' => 'startDate']) !!}
                                                {!! Form::date('endDate', request()->endDate, ['class' => 'form-control form-control-sm mr-2', 'placeholder' => 'End Date', 'title' => 'End Date', 'id' => 'endDate']) !!}
                                                <button type="button" name="go" class="view-btn" id="searchPackage">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table shp-table">
                                        <thead>
                                            <tr>
                                                <th>{!! Form::checkbox('checkAll', 1, '', ['id' => 'checkAll']) !!}</th>
                                                <th>S.n</th>
                                                <th>Shipment Code</th>
                                                <th>Shipper</th>
                                                <th>Consignee</th>
                                                <th>Pcs</th>
                                                <th>Weight(KGS)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showTheShipment">

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
                        @if ($bag->id)
                            <div class="col-md-12">
                                <div class="card row mt-2">
                                    <div class="card-header">Previously Selected Shipment</div>
                                    <div class="card-body row">
                                        <div class="card-body row col-12">
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th style="width: 10px">S.N</th>
                                                            <th>Shipment Code</th>
                                                            <th>Sender</th>
                                                            <th>Receiver</th>
                                                            <th>Pcs</th>
                                                            <th>Weight(KGS)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($bag->shipment->groupBy('shipmentPackageId') as $key => $item)
                                                            @foreach ($item as $package)
                                                                @if ($loop->first)
                                                                    <tr>
                                                                        <td>
                                                                            {!! Form::checkbox('shipmentId[]', $package->shipmentPackage->id, 'checked', ['class' => 'selectCheckBox']) !!}
                                                                        </td>
                                                                        <td>{{ $key + 1 }}.</td>
                                                                        <td>{{ @$package->shipmentPackage->barcode }}</td>
                                                                        <td> {{ @$package->shipmentPackage->senderAttention }}
                                                                        </td>
                                                                        <td> {{ @$package->shipmentPackage->receiverAttention }}
                                                                        </td>
                                                                        <td>{{ @$package->shipmentPackage->totalPiece }}
                                                                        </td>
                                                                        <td>{{ @$package->shipmentPackage->total_weight }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            style="border-bottom:none;border-left:none;background:none;">
                                                                        </th>
                                                                        <th></th>
                                                                        <th> Total Piece</th>
                                                                        <th>Dimensions</th>
                                                                        <th>weight</th>
                                                                    </tr>
                                                                @endif
                                                                <tr class="pkg-table">
                                                                    <td
                                                                        style="border-right:none;border-left:none;border-top:none;border-bottom:none;">
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::checkbox('shipmentItemId[]', $package->id, 'checked', ['class' => 'selectCheckBox']) !!}
                                                                    </td>
                                                                    <td>{{ $package->piece_number }}</td>
                                                                    <td>{{ $package->length . '*' . $package->width . '*' . $package->height }}
                                                                    </td>
                                                                    <td>{{ $package->weight }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
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
                            </div>
                        @endif

                        <div class="col-md-12">
                            <button type="submit" class="global-btn">Submit</button>
                            <button type="Reset" class="global-btn">Reset</button>

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
