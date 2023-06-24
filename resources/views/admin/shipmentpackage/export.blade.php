@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
            }
        });

        function terms_changed(termsCheckBox) {
            if (termsCheckBox.checked) {
                document.getElementById("submit_button").disabled = false;
            } else {
                document.getElementById("submit_button").disabled = true;
            }
        }
        $('#serviceAgent').on('change', function() {
            console.log('hello');
            $('#serviceAgentHidden').val($(this).val())
        })
    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <div class="container-fluid">
        <div class="b-noti-col">
            <div class="b-noti-btn">
                <div class="b-noti-left common-btns">

                </div>

            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }} List</h3>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="">
                                <div class="row">
                                    <x-agent-component />
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {!! Form::select('service_agent', $serviceAgent, request()->service_agent, ['class' => 'form-control form-control-sm', 'placeholder' => 'Choose Integrator']) !!}
                                    </div>


                                    @if (request()->is('nd-admin/awb-invoiced'))
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            {!! Form::select('invoice', ['0' => 'not-billed', '1' => 'Billed'], request()->invoice, ['class' => 'form-control form-control-sm', 'placeholder' => 'Billed/Not Billed']) !!}
                                        </div>
                                    @endif
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        {!! Form::date('startDate', @request()->startDate, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        {!! Form::date('endDate', @request()->endDate, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    {{-- {{ Form::open(['method' => 'post','route' => 'shipmentpackage.generate.awb.bulk']) }} --}}
                    {{ Form::open(['method' => 'post', 'route' => 'exportShipmentPackage']) }}
                    <input type="hidden" name="serviceAgent" id="serviceAgentHidden" value="{{ $firstServiceAgent }}">

                    <table class="table table-bordered" id="table1">
                        <thead>
                            <tr class="text-capitalize text-small">
                                <th><input type="checkbox" id="selectAll" onclick="terms_changed(this)" /></th>
                                <th style="width: 10px">S.n</th>

                                <th>Awb Number</th>
                                <th>Date</th>
                                <th>Shipper</th>
                                <th>Consignee</th>
                                <th>Pcs</th>
                                <th>Weight (KGs)</th>
                                <th>destination</th>
                               <th>Service Provider </th>
                                <th>Status</th>
                                <th>Action</th>
                                <th> AWB</th>
                                <th> Label</th>
                                @if (request()->is('nd-admin/manifestedShipmentPackage*'))
                                    <th>Docs</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr data-id="{{ @$value->id }}" class="row1">
                                    <td><input type="checkbox" onclick="terms_changed(this)" class="checked"
                                            name="ids[]" value="{{ $value->id }}" /></td>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->awb_number }}</td>
                                    <td>{{ $value->created_at->format('d-M-y') }}</td>
                                    <td> {{ @$value->senderName }} </td>
                                    <td> {{ @$value->receiverCompany }} </td>
                                    <td>{{ @$value->totalPiece }}</td>
                                    <td>{{ @$value->total_weight }}</td>
                                    <td>{{ $value->receiverCountry }}</td>
                                    <td>{{ $value->getServiceAgent->title }}</td>
                                    <td>
                                        @can('change-awb-status')

                                        <a class="view-btn"
                                            href="{{ route('shipmentpackage-location', $value->id) }}"
                                            role="button" title="Update Status">{{ @$value->package_status }}</a>
                                            @else
                                            {{ @$value->package_status }}
                                        @endcan
                                        </td>

                                    <td class="text-center">

                                        <div class="btn-group">
                                            @can('shipment-show')
                                                <a href="{{ route('shipmentpackage.show', $value->id) }}"
                                                    title="View Shipment Package" class="view-btn"><i
                                                        class="fas fa-eye"></i></a>
                                            @endcan

                                            @can('shipment-edit')
                                                <a href="{{ route('shipmentpackage.edit', $value->id) }}"
                                                    title="Edit Shipment Package" class="view-btn ml-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @if ($value->package_status == 'APPROVED')
                                                <button type="button" class="global-btn ml-1" role="button"
                                                    data-value="{{ $value->id }}">
                                                    Received
                                                </button>
                                            @endif
                                            {{-- @if ($value->package_status == 'MANIFESTED')
                                                @include('admin.shipmentpackage.modal')
                                            @endif --}}
                                        </div>
                                    </td>
                                    <td>
                                        @can('generate-awb')
                                            <a href="{{ route('shipmentpackage.generate.awb', $value->id) }}"
                                                title="Print Air Way Bill" class="view-btn ml-1" target="_blank">
                                                <i class="fas fa-print"></i></a>
                                        @endcan
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" title="Print Label" class="view-btn">
                                            <i class="fas fa-tags "></i></a>
                                    </td>
                                    @if (request()->is('nd-admin/manifestedShipmentPackage*'))
                                        <td>
                                            <a href="{{ route('downloadDocument', $value->id) }}"
                                                title="Download Document" class="view-btn ml-1" target="_blank">
                                                <i class="fas fa-download"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ Form::button('Generate Air Waybill', ['class' => 'btn btn-dark btn-sm','id'=>"submit_button", 'type' => 'submit','disabled'=>'true']) }} --}}
                    {{-- {{ Form::button('Export Shipment Package', ['class' => 'btn btn-dark btn-sm', 'id' => 'submit_button', 'type' => 'submit', 'disabled' => 'true']) }} --}}
                    {{-- <a href="{{route('exportShipmentPackage')}}">Export</a> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="global-btn" data-toggle="modal" data-target="#exampleModal"
                        id="submit_button" disabled>
                        Export Shipment Package
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Shipment Export</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input class="form-control form-control-sm" type="text" placeholder="Title" name="title"
                                        required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="global-btn" data-dismiss="modal">Close</button>
                                    <button type="submit" class="global-btn">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}

                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $data->firstItem() }}</strong> to
                                    <strong>{{ $data->lastItem() }} </strong> of <strong>
                                        {{ $data->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $data->links() }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
