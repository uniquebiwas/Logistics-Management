@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script>
        $("#trackData").hide();
        $("#trackdhl").click(function() {
            $.ajax({
                url: "{{ route('shipmentpackage.trackdhl') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    shipmentId: "{{ $shipmentPackage_info->id }}"
                },
                success: function(response) {
                    console.log(response);
                    $("#trackData").show();
                    $("#trackingData").empty();
                    for (let i = 0; i < response.length; i++) {
                        $("#trackingData").append("<tr><td>" + response[i].sender.address + "(" +
                            response[i].sender.country + ")</td><td>" + response[i].receiver
                            .address + "(" + response[i].receiver.country + ")</td><td>" + response[
                                i].status.description + " (" + response[i].status.status +
                            ")</td><td>" + response[i].timeofdelivery + "</td></tr>");
                    }
                }
            });
        });
    </script>
@endpush
@section('content')
    @php
    $percentage = 0;
    $color = 'primary';
    switch ($shipmentPackage_info->package_status) {
        case 'PENDING':
            $percentage = 0;
            $color = 'warning';
            break;

        case 'CANCELLED':
            $percentage = 0;
            $color = 'danger';
            break;
        case 'RECEIVED':
            $percentage = 10;
            $color = 'warning';
            break;
        case 'MANIFESTED':
            $percentage = 20;
            $color = 'warning';
            break;
        case 'SCHEDULED':
            $percentage = 30;
            $color = 'secondary';
            break;
        case 'DISPATCHED':
            $percentage = 50;
            $color = 'primary';
            break;
        case 'ARRIVED AT DUBAI':
            $percentage = 80;
            $color = 'info';
            break;

        case 'TRACKING CODE UPDATED':
            $percentage = 90;
            $color = 'info';
            break;
        case 'DELIVERED':
            $percentage = 100;
            $color = 'success';
            break;
        default:
            $percentage = 0;
            $color = 'light';
            break;
    }
    @endphp
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <h4 class="mb-0">{{ @$shipmentPackage_info->barcode }}</h4>
                            <br>
                            <img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG("$shipmentPackage_info->barcode", 'C39', 1, 36) }}"
                                alt="barcode" />
                        </div>
                        <div class="col-lg-4 float-middle text-center">
                            <h4 class="mb-0">{{ @$shipmentPackage_info->package_name }}</h4>
                        </div>
                        @if ($shipmentPackage_info->package_status != 'CANCELLED')
                            <div class="col-lg-4">
                                <div class="float-right dropdown dropleft">
                                    <button class="btn btn-{{ $color }} btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Order Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @hasanyrole('Super Admin|Admin|Agent')
                                        @if ($shipmentPackage_info->package_status == 'PENDING')
                                            <button type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#cancelModal"> Cancel Shipment
                                            </button>
                                        @endif
                                        @endhasanyrole
                                        @hasanyrole('Super Admin|Admin')
                                        @if ($shipmentPackage_info->package_status == 'PENDING')
                                            {{ Form::open(['method' => 'POST', 'route' => ['shipmentpackage.approve', $shipmentPackage_info->id], 'onsubmit' => 'return confirm("Are you sure you received this shipment package?")']) }}
                                            {{ Form::button('Approve Shipment', ['class' => 'dropdown-item', 'type' => 'submit', 'title' => 'Shipment Received']) }}
                                            {{ Form::close() }}
                                        @endif
                                        @if ($shipmentPackage_info->package_status == 'APPROVED')
                                            {{ Form::open(['method' => 'POST', 'route' => ['shipmentpackage.receive', $shipmentPackage_info->id], 'onsubmit' => 'return confirm("Are you sure you received this shipment package?")']) }}
                                            {{ Form::button('Shipment Received', ['class' => 'dropdown-item', 'type' => 'submit', 'title' => 'Shipment Received']) }}
                                            {{ Form::close() }}
                                        @endif
                                        @if ($shipmentPackage_info->package_status == 'RECEIVED')
                                            <button type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#scheduleModal">
                                                Schedule Shipment
                                            </button>
                                        @endif
                                        @if ($shipmentPackage_info->package_status == 'SCHEDULED')
                                            <button type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#scheduleModal">
                                                Reschedule Shipment
                                            </button>

                                        @endif


                                        @if ($shipmentPackage_info->package_status == 'DISPATCHED' || $shipmentPackage_info->package_status == 'SCHEDULED' || $shipmentPackage_info->package_status == 'INCARGO' || $shipmentPackage_info->package_status == 'DELIVERED')
                                            {{ Form::open(['method' => 'GET', 'target' => '_blank', 'route' => ['shipmentpackage.generate.awb', $shipmentPackage_info->id]]) }}
                                            {{ Form::button('Generate Air Waybill', ['class' => 'dropdown-item', 'type' => 'submit']) }}
                                            {{ Form::close() }}
                                            {{ Form::open(['method' => 'GET', 'target' => '_blank', 'route' => ['shipmentpackage.generate.awb', $shipmentPackage_info->id]]) }}
                                            {{ Form::button('Generate Master Air Waybill', ['class' => 'dropdown-item', 'type' => 'submit']) }}
                                            {{ Form::close() }}
                                        @endif
                                        <a href="{{ route('shipmentpackage-location', $shipmentPackage_info->id) }}"
                                            class="dropdown-item text-capitalize">update location</a>
                                        @endhasanyrole
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row col-lg-12 mt-4">

                        <div class="col-lg-4">
                            <p>Package Creation Date</p>
                            <p class="btn btn-{{ $color }}">
                                {{ ReadableDate(@$shipmentPackage_info->created_at, 'ymd') }}</p>
                        </div>
                        <div class="col-lg-8">
                            <p>Status <small>({{ $percentage }}% COMPLETE)</small> </p>
                            <div class="progress">
                                <div class="progress-bar bg-{{ $color }} progress-bar-striped" role="progressbar"
                                    aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{ $percentage }}%">
                                    <span class="sr-only">{{ $percentage }}% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Shipment(Service) Agent</th>
                                    <th>Shipment Package Type</th>
                                    <th>Shipment Package Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <strong> {{ @$shipmentPackage_info->getServiceAgent->title }}</strong></td>
                                    <td> <strong> {{ @$shipmentPackage_info->getPackageType->package_type }}</strong>
                                    <td> <strong class="text-{{ $color }}">
                                            {{ strtoupper(@$shipmentPackage_info->getStatusLevel->title) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row" id="trackData">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Package Tracking from {{ @$shipmentPackage_info->getServiceAgent->title }}
                        </div>
                        <div class="card-body">
                            <table class="table text-center table-borderless">
                                <thead>
                                    <tr>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th>Status</th>
                                        <th>Time of delivery</th>
                                    </tr>
                                </thead>
                                <tbody id="trackingData">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Order Details
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="float-left">
                                            <p class="text-bold">Shipper</p>
                                            <span>
                                                Name : {{ $shipmentPackage_info->senderName }}
                                                <br />
                                                Address:
                                                {{ $shipmentPackage_info->senderAddress }} <br />
                                                Country:
                                                {{ $shipmentPackage_info->senderCountry }} <br />
                                                Mobile:
                                                {{ @$shipmentPackage_info->senderMobile }}<br />
                                                Email :
                                                {{ @$shipmentPackage_info->senderEmail }}
                                                Shipped By :
                                                {{ @$shipmentPackage_info->getAgent->agent_profile->company_name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="float-right">
                                            <p class="text-bold">Consignee</p>

                                            <span>
                                                Name :
                                                {{ $shipmentPackage_info->receiverCompany }}
                                                <br />
                                                Address:
                                                {{ $shipmentPackage_info->receiverAddress }} <br />
                                                Country:
                                                {{ $shipmentPackage_info->receiverCountry }} <br />
                                                Mobile:
                                                {{ @$shipmentPackage_info->receiverMobile }}<br />
                                                Email :
                                                {{ @$shipmentPackage_info->receiverEmail }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                                                                                                                                                                                    <p>Remarks: &nbsp;</p>
                                                                                                                                                                                                    <p>{{ @$shipmentPackage_info->remarks }}</p>
                                                                                                                                                                                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Shipment Detail
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.n</th>
                                                    <th>Qty</th>
                                                    <th>Length (in CM)</th>
                                                    <th>Breadth (in CM)</th>
                                                    <th>Height (in CM)</th>
                                                    <th>Weight (in KG)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $totalWeight = 0; @endphp
                                                @foreach ($shipmentPackage_info->getItems as $key => $item)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $item->piece_number }}</td>
                                                        <td>{{ $item->length }}</td>
                                                        <td>{{ $item->width }}</td>
                                                        <td>{{ $item->height }}</td>
                                                        <td>{{ $item->weight }}</td>
                                                    </tr>
                                                    @php $totalWeight = $totalWeight + $item->weight; @endphp
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>

                                                    <th colspan="5">Total</th>
                                                    <th>{{ @$totalWeight }} Kgs</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- <div class="row mt-4">
                                                                                                                                                                                                    <div class="col-lg-6">
                                                                                                                                                                                                        <div class="float-left">
                                                                                                                                                                                                            <p>Payment Type</p>
                                                                                                                                                                                                            <strong>{{ @$shipmentPackage_info->payment_type }}</strong>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    <div class="col-lg-6">
                                                                                                                                                                                                        <div class="float-right">
                                                                                                                                                                                                            <p>Payment Method</p>
                                                                                                                                                                                                            <strong>{{ @$shipmentPackage_info->payment_method }}</strong>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-12">
                @if ($shipmentPackage_info->package_status == 'CANCELLED')
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                Cancellation Summary
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="float-left">
                                                <p>Cancelled By: </p>
                                                <p><strong>{{ @$shipmentPackage_info->getCancellationBy->name['en'] }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="float-right">
                                                <p>Cancelled At: </p>
                                                <p><strong>{{ ReadableDate(@$shipmentPackage_info->cancelled_at, 'all') }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p>Cancellation Remarks: &nbsp;</p>
                                        <p>{{ @$shipmentPackage_info->cancellation_remarks }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Button trigger modal -->

    @if ($shipmentPackage_info->package_status == 'PENDING')
        <!-- Modal -->
        <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">Cancel
                            {{ @$shipmentPackage_info->package_name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @hasanyrole('Super Admin|Admin')
                    {{ Form::open(['url' => route('shipmentpackage.decline', @$shipmentPackage_info->id), 'class' => 'form', 'name' => 'shipment_cancel_form']) }}
                    @endhasanyrole
                    @role('Agent')
                    {{ Form::open(['url' => route('shipment.cancel', @$shipmentPackage_info->id), 'class' => 'form', 'name' => 'shipment_cancel_form']) }}
                    @endrole
                    <div class="modal-body col-12">
                        {{ Form::label('cancellation_reason', 'Cancellation Reason :*') }}
                        {{ Form::select('cancellation_reason', @$cancellation_reasons, @$feature_info->cancellation_reason, ['id' => 'cancellation_reason', 'required' => true, 'class' => 'form-control']) }}
                        {{ Form::label('cancellation_remarks', 'Cancellation Remarks :*') }}
                        {{ Form::textarea('cancellation_remarks', @$feature_info->cancellation_remarks, ['id' => 'cancellation_remarks', 'class' => 'form-control']) }}
                    </div>
                    <div class="modal-footer">
                        {{ Form::button(' Submit', ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                        <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endif
    {{-- @if ($shipmentPackage_info->package_status == 'RECEIVED' || $shipmentPackage_info->package_status == 'SCHEDULED') --}}
    <!-- Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleModalLabel">Schedule
                        {{ @$shipmentPackage_info->package_name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['url' => route('shipmentpackage.schedule', @$shipmentPackage_info->id), 'class' => 'form', 'name' => 'shipment_schedule_form']) }}
                <div class="modal-body col-12">
                    <div class="form-group">
                        {{ Form::label('scheduled_for', 'Schedule For :*') }}
                        {{ Form::date('scheduled_for', @$shipmentPackage_info->scheduled_for, ['id' => 'scheduled_for', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                        @error('scheduled_for')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('flightNumber', 'Flight Number :*') }}
                        {{ Form::text('flightNumber', @$shipmentPackage_info->flightNumber, ['id' => 'flightNumber', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('airlines', 'Airline :*') }}
                        {{ Form::text('airlines', @$shipmentPackage_info->airlines, ['id' => 'airlines', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                    </div>

                </div>

                <div class="modal-footer">
                    {{ Form::button(' Submit', ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                    <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    {{-- @endif --}}


@endsection
