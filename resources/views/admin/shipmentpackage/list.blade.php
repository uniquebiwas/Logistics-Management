@extends('layouts.admin')
@section('title', $title)

@push('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>

    <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var all = [];

            $('.receive').on('click', function() {
                id = $(this).attr('data-value');
                var url = "{{ route('shipmentpackage.receive', ':id') }}";
                url = url.replace(':id', id);
                axios.post(url)
                    .then(function(response) {
                        toastr.success('package Has been received successfully', 'success!');
                        location.reload();
                    })
                    .catch(function(error) {
                        toastr.error('error!', 'Error Occour')
                    });

            })
        });

        $("#selectAll").click(function() {
            $("input[type=checkbox]").not("[disabled]").prop("checked", $(this).prop("checked"));
        });

        $('#submit_button').on('click', function() {
            var val = [];
            var url = "{{ route('shipmentpackage.generate.awb.bulk') }}"
            $('.checked:checked').each(function() {
                val.push($(this).val());
            })
            if (val.length == 0) {
                return toastr.error('error!', 'Select At least one AWB to generate');
            }

            axios({
                method: 'post',
                url: url,
                responseType: 'blob',
                data: {
                    'ids': val,
                }
            }).then((response) => {

                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'uploads.zip'); //or any other extension
                document.body.appendChild(link);
                link.click();
                location.reload();

            });

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
    </script>
    {{-- <script>
        $('#table1').dataTable({
            "bFilter": false,
            "lengthMenu": [
                [10, 50, 200, -1],
                [10, 50, 200, "All"]
            ],
            "pageLength": 10,
            //    "pagingType": "full_numbers",
            //    paging: false,
            //    info:false,
            //    "order": [[ 3, "desc" ]]

        });
    </script> --}}

@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <div class="container-fluid">
        <div class="b-noti-col">
            <div class="b-noti-btn">
                <div class="b-noti-left common-btns">
                    @role('Agent')
                        <a href="{{ route('shipment.create') }}" class="global-btn">Create AWB</a>
                    @endrole
                    @role('Super Admin')
                        <a href="{{ route('shipmentpackage.create') }}" class="global-btn">Create AWB</a>
                    @endrole

                </div>
                <!-- <div class="b-noti-right common-btns">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button type="submit" class="btn -btn-primary">Manage Lists</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button type="submit" class="btn -btn-primary">Party Collection</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
            </div>
        </div>
    </div>
    <section class="content shipment-list">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Shipment Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="p-1 col-lg-12">
                            <form action="">
                                <div class="row">
                                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'AWB admin']))
                                        <x-agent-component />
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            {!! Form::select('service_agent', $serviceAgent, request()->service_agent, ['class' => 'form-control form-control-sm', 'placeholder' => 'All service agent']) !!}
                                        </div>
                                    @endif

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
                                <th> AWB</th>

                                @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'AWB admin']))
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                                @if (auth()->user()->hasAnyRole(['Agent', 'Staff']))
                                    <th>Action</th>
                                @endif
                                {{-- <th> Label</th> --}}
                                <th>Docs</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr data-id="{{ @$value->id }}" class="row1">
                                    <td><input type="checkbox" onclick="terms_changed(this)" class="checked"
                                            name="ids[]" value="{{ $value->id }}"
                                            {{ $value->loads_count ? 'disabled' : null }} /></td>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>
                                        <a href="{{ route('clientPackageSearch', ['tracking_id'=>$value->barcode]) }}"
                                            target="_blank">
                                            {{ @$value->awb_number }}</a>
                                    </td>
                                    <td>{{ $value->created_at->format('d-M-y') }}</td>
                                    <td> {{ @$value->senderName }} </td>
                                    <td> {{ @$value->receiverCompany }} </td>
                                    <td>{{ @$value->totalPiece }}</td>
                                    <td>{{ bcdiv(@$value->total_weight, 1, 3) }}</td>
                                    <td>{{ $value->receiverCountry }}</td>
                                    <td>{{ $value->getServiceAgent->title }}
                                        @if ($value->trackingCode)
                                            {{ $value->trackingCode }}
                                        @endif
                                    </td>
                                    <td>
                                        @can('generate-awb')
                                            <a href="{{ route('shipmentpackage.generate.awb', $value->id) }}"
                                                title="Print Air Way Bill" class="view-btn" target="_blank">
                                                <i class="fas fa-print"></i></a>
                                        @endcan
                                    </td>
                                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'AWB admin']))
                                        <td>
                                            @can('change-awb-status')

                                                <a class="view-btn" style="padding:3px 8px;font-size: 12px;"
                                                    href="{{ route('shipmentpackage-location', $value->id) }}" role="button"
                                                    title="Update Status">{{ @$value->package_status }}</a>
                                            @else
                                                {{ @$value->package_status }}
                                            @endcan
                                        </td>
                                    @endif
                                    @if (auth()->user()->hasAnyRole(['Agent', 'Staff']))
                                        <td>
                                            <a href="{{ route('shipmentpackage.generate.awb', $value->id) }}"
                                                title="Print Air Way Bill" class="view-btn" target="_blank">
                                                <i class="fas fa-eye"></i></a>
                                        </td>
                                    @endif

                                    <td class="text-center">
                                        <div class="btn-group">
                                            @can('shipment-receipt')
                                                <a href="{{ route('getReceipt', $value->id) }}" title="Receipt"
                                                    class="view-btn" target="_blank">
                                                    <i class="fas fa-receipt    "></i>
                                                </a>
                                            @endcan
                                            @can('shipment-show')
                                                <a href="{{ route('shipmentpackage.show', $value->id) }}" title="View Shipment Package"
                                                    class="view-btn"><i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can('shipment-edit')
                                                @role('Agent')
                                                    @if ($value->package_status == 'PENDING')
                                                        <a href="{{ route('shipmentpackage.edit', $value->id) }}"
                                                            title="Edit Shipment Package" class="view-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('shipmentpackage.edit', $value->id) }}"
                                                        title="Edit Shipment Package" class="view-btn">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endrole

                                            @endcan
                                            @if ($value->package_status == 'APPROVED')
                                                <button type="button" class="global-btn" role="button"
                                                    data-value="{{ $value->id }}">
                                                    Received
                                                </button>
                                            @endif
                                            @if ($value->package_status == 'MANIFESTED')
                                                @include('admin.shipmentpackage.modal')
                                            @endif
                                        </div>
                                    </td>

                                    {{-- <td>
                                        <a href="javascript:void(0)" title="Print Label" class="view-btn">
                                            <i class="fas fa-tags "></i></a>
                                    </td> --}}

                                    <td>
                                        @if ($value->shipment_files_count)
                                            <a href="{{ route('downloadDocument', $value->id) }}"
                                                title="Download Document" class="view-btn" target="_blank">
                                                <i class="fas fa-download"></i></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="dt-btn">
                        {{-- {{ Form::button('Print Multiple AWB', ['class' => 'global-btn', 'id' => 'submit_button', 'type' => 'submit', 'disabled' => 'true']) }} --}}
                        @if (request()->is('nd-admin/manifestedShipmentPackage'))
                            <x-schedule-component />
                        @endif

                        @if (request()->is('nd-admin/receivedShipmentPackage'))
                            <x-load-component />
                        @endif
                    </div>


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
