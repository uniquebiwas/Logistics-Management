@extends('layouts.admin')
@section('title', 'Shipment Location')
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function received() {
            if (['RECEIVED','DELIVERED','MANIFESTED'].includes($('#package_status').val())) {
                $('#received_child').removeClass('d-none');
            }

            if ($('#package_status').val() == 'HANDOVERTOAGENT') {
                $('#tracking_code_form').removeClass('d-none');
            }

            if ($('#pacakge_status').val() == 'DISPATCHED') {
                $('#tracking_code_form').removeClass('d-none');
            }
        }
        $(document).ready(function() {
            received();

            $("input[type=datetime-local]").on("change", function() {
                this.setAttribute('data-date', '');
                this.setAttribute('placeholder', 'DD/MM/YYYY');
                if (this.value) {
                    this.setAttribute(
                        "data-date",
                        moment(this.value, "YYYY-MM-DD'T'HH:mm")
                        .format('DD/MM/YYYY h:mm:ss A')
                    )
                }

            }).trigger("change");

            $('#package_status').on('change', function() {
                $('#received_child').addClass('d-none');
                $('#tracking_code_form').addClass('d-none');
                received();

            })
            $('#extra_status').on('change', function() {
                $('#tracking_code_form').addClass('d-none');
                if ($(this).val() == 'Hand Over To Agent') {
                    $('#tracking_code_form').removeClass('d-none');
                }
                if ($(this).val() == 'Arrived At Hub') {
                    $('#tracking_code_form').removeClass('d-none');
                }
            })

            $('#updateStatus').on('click', (e) => {
                var c = confirm("Are you sure to update this status?");
                return c;
            })
        })
    </script>
@endpush
@section('content')
    @php
    $percentage = 0;
    $color = 'primary';
    switch ($package->package_status) {
        case 'PENDING':
            $percentage = 10;
            $color = 'warning';
            break;

        case 'CANCELLED':
            $percentage = 0;
            $color = 'danger';
            break;
        case 'RECEIVED':
            $percentage = 20;
            $color = 'warning';
            break;
        case 'MANIFESTED':
            $percentage = 40;
            $color = 'warning';
            break;
        case 'SCHEDULED':
            $percentage = 60;
            $color = 'secondary';
            break;
        case 'DISPATCHED':
            $percentage = 80;
            $color = 'primary';
            break;
        case 'IN TRANSIT':
            $percentage = 70;
            $color = 'white';
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
    <section class="content-header mt-0 pt-0"></section>
    <div class="row">
        <div class="offset-2 col-md-8 mb-1">
            <p>{{ $package->package_status }} <small>({{ $percentage }}% COMPLETE)</small> </p>
            <div class="progress">
                <div class="progress-bar bg-{{ $color }} progress-bar-striped" role="progressbar"
                    aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"
                    style="width: {{ $percentage }}%">
                    <span class="sr-only">{{ $percentage }}% Complete (success)</span>
                </div>
            </div>
        </div>
        <div class="offset-2 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> {{ $package->awb_number }} Update Location And Status Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('shipmentpackage-location-store', $package->id) }}"
                    method="post" id="locationform">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-10">
                                {!! Form::select('location', $location, '', ['class' => 'form-control', 'id' => 'location']) !!}

                                @error('location')
                                    <span class="text-danger text-capitalize"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="countryId" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                {!! Form::select('countryId', $countries, old('countryId') ?? 148, ['class' => 'form-control', 'id' => 'countryId']) !!}
                                @error('countryId')
                                    <span class="text-danger text-capitalize"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="locationDate" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                {!! Form::dateTimeLocal('date', now(), ['class' => 'form-control', 'id' => 'locationDate', 'placeholder' => 'd/m/YYYY']) !!}
                                @error('date')
                                    <span class="text-danger text-capitalize"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_status" class="col-sm-2 col-form-label">Shpt. Status</label>
                            <div class="col-sm-10">
                                {{-- {!! Form::select('statusId', $statusLevel, old('statusId'), ['class' => 'form-control', 'id' => 'statusId']) !!} --}}
                                <select name="package_status" id="package_status" class="form-control">
                                    @if ($package->package_status == 'PENDING')
                                        <option value="RECEIVED">RECEIVED</option>
                                        <option value="HANDOVERTOAGENT">HAND OVER TO AGENT</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                    @endif
                                    @if ($package->package_status == 'RECEIVED')
                                        <option value="MANIFESTED">MANIFESTED</option>
                                    @endif

                                    @if ($package->package_status == 'MANIFESTED')

                                        <option value="SCHEDULED">SCHEDULED</option>
                                    @endif

                                    @if ($package->package_status == 'SCHEDULED')

                                        <option value="DISPATCHED">DISPATCHED</option>
                                    @endif

                                    @if ($package->package_status == 'DISPATCHED')
                                        <option value="DELIVERED">DISPATCHED</option>
                                    @endif
                                    @if ($package->package_status == 'DELIVERED')
                                    <option value="DELIVERED">DELIVERED</option>
                                @endif
                                </select>
                                @error('package_status')
                                    <span class="text-danger text-capitalize"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-none row" id="received_child">
                            @if ($package->package_status == 'PENDING')
                                {!! Form::select('extra_status', $receivedStatus, old('receivedStatus'), ['class' => 'form-control text-uppercase form-control-sm offset-sm-2 col-sm-10 ', 'id' => 'extra_status']) !!}
                            @endif
                            @if ($package->package_status == 'DISPATCHED'  || $package->package_status == 'DELIVERED')
                                {!! Form::select('extra_status', $dispatchedStatus, '', ['class' => 'form-control text-uppercase form-control-sm offset-sm-2 col-sm-10 ', 'id' => 'extra_status']) !!}
                            @endif
                            @if ($package->package_status == 'RECEIVED')
                                {!! Form::select('extra_status', @$manifestedStatus, '', ['class' => 'form-control text-uppercase form-control-sm offset-sm-2 col-sm-10 ', 'id' => 'extra_status']) !!}
                            @endif
                        </div>

                        <div class="form-group row  {{ $package->package_status == 'DISPATCHED'  || $package->package_status == 'DELIVERED' ? '' : 'd-none'  }}"
                            id="tracking_code_form">
                            <label for="tracking_code"
                                class="col-sm-2 col-form-label text-sm">{{ $package->getServiceAgent->title }}
                                Tracking code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="tracking_code"
                                    placeholder="Tracking Code" name="tracking_code"
                                    value="{{ old('tracking_code', $package->tracking_code) }}">
                                @error('tracking_code')
                                    <span class="text-danger text-capitalize"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($package->package_status == 'MANIFESTED')

                            <div class="form-group row">

                                <label for="scheduled_for" class="col-sm-2 col-form-label">Flight Date</label>
                                <div class="col-sm-10">
                                    {{ Form::date('scheduled_for', @$value->scheduled_for, ['id' => 'scheduled_for', 'class' => 'form-control', 'required' => 'required']) }}
                                    @error('scheduled_for')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">

                                <label for="flightNumber" class="col-sm-2 col-form-label">Flight Number</label>
                                <div class="col-sm-10">

                                    {{ Form::text('flightNumber', @$value->flightNumber, ['id' => 'flightNumber', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}

                                    @error('flightNumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">

                                <label for="airlines" class="col-sm-2 col-form-label">Airline</label>
                                <div class="col-sm-10">

                                    {{ Form::text('airlines', @$value->airlines, ['id' => 'airlines', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}

                                    @error('scheduled_for')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="remarks" placeholder="Remarks" name="remarks"
                                    value="{{ old('remarks') }}">
                                @error('remarks')
                                    <span class="text-danger text-capitalize"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="global-btn"
                            id="updateStatus">Update
                            Status</button>
                        <button type="reset" class="global-btn">Reset</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
    <section class="content create-consigment">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="timeline">
                        @foreach ($shipmentPackage as $location)
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-red">{{ readableDate($location[0]->date, 'date') }}</span>
                            </div>
                            @foreach ($location as $data)
                                @php
                                    switch ($data->package_status) {
                                        case 'PENDING':
                                            $shipmentLocation = 'AWB GENERATED';
                                            break;
                                        case 'DISPATCHED':
                                            $shipmentLocation = 'SHIPMENT IN TRANSIT';
                                            break;

                                        default:
                                            $shipmentLocation = $data->package_status;
                                            break;
                                    }
                                @endphp
                                <div>
                                    <i class="fas fa-compass bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i>
                                            {{ readableDate($data->date, 'time') }}</span>
                                        <h3 class="timeline-header no-border text-capitalize">
                                            <b>{{ @$data->location . ', ' . @$data->country->name }}</b> at
                                            {{ readableDate($data->date, 'time') }}
                                        </h3>
                                        <div class="timeline-body">
                                            <b>Status: </b>{{ @$shipmentLocation }} {{ $data->extra_status }}

                                        </div>
                                        @if ($data->remarks)
                                            <div class="timeline-footer">
                                                <b>Note: </b>{{ @$data->remarks }}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                        @endforeach

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
