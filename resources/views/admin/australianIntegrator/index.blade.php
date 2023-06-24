@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });

        const terms_changed = function(termsCheckBox) {
            var val = [];
            $('.checked:checked').each(function() {
                val.push($(this).val());
            })
            if (val.length > 0) {
                document.getElementById("sendApi").disabled = true;
            } else {
                document.getElementById("sendApi").disabled = false;

            }
        }

        $('#sendApi').on('click', function() {
            var val = [];
            $('.checked:checked').each(function() {
                val.push($(this).val());
            })
        })
        $('#deleteOrder,#sendOrder').on('click', () => confirm('Please Proceed With Extreme Cautions only?'));
    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content shipment-list">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Shipment List</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="p-1 col-lg-12">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-2">
                                        {!! Form::select('limit', ['1' => 1, '10' => 10, '50' => 50, '100' => 100, '500' => 500], request()->limit, ['class' => 'form-control form-control-sm', 'placeholder' => 'Limit']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        {!! Form::select('imported', ['imported' => 'imported', 'notImported' => 'not Imported'], request()->imported, ['class' => 'form-control form-control-sm', 'placeholder' => 'Package Status']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        {!! Form::text('keyword', request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search awb number']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        {!! Form::date('startDate', request()->startDate, ['class' => 'form-control form-control-sm', 'placeholder' => 'Start Date']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        {!! Form::date('endDate', request()->endDate, ['class' => 'form-control form-control-sm', 'placeholder' => 'End Date']) !!}
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shipments as $key => $value)
                                <tr data-id="{{ @$value->id }}" class="row1">
                                    <td><input type="checkbox" onclick="terms_changed(this)" class="checked"
                                            name="ids[]" value="{{ $value->id }}" /></td>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>
                                        {{ @$value->awb_number }}
                                    </td>
                                    <td>{{ $value->created_at->format('d-M-y') }}</td>
                                    <td> {{ @$value->senderName }} </td>
                                    <td> {{ @$value->receiverCompany }} </td>
                                    <td>
                                        @if ($value->orderImport)
                                            <a href="{{ route('order-status', $value->orderImport->id) }}"
                                                class="global-btn  ml-1" title="Check status on API">
                                                {{ optional($value->orderImport)->clear_status }}
                                            </a>
                                            @if ($value->orderImport->status == 3)
                                                <a href="{{ route('order-get-label', $value->orderImport->id) }}"
                                                    class="view-btn  ml-1" title="get Label">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            @endif
                                        @else
                                            un-assigned
                                        @endif

                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if ($value->orderImport)
                                                {!! Form::open(['url' => route('order-delete', $value->orderImport->id)]) !!}
                                                @method('delete')
                                                {!! Form::button('<i class="fas fa-trash"></i>', ['class' => 'view-btn', 'type' => 'submit', 'id' => 'deleteOrder']) !!}
                                                {!! Form::close() !!}


                                                @if (!$value->orderImport->allocated)
                                                {!! Form::open(['url' => route('order-quickAllocation', $value->orderImport->id)]) !!}
                                                @method('POST')

                                                {!! Form::button('<i class="fas fa-adjust "></i>', ['class' => 'view-btn ml-1', 'type' => 'submit', 'id' => 'deleteOrder']) !!}
                                                {!! Form::close() !!}
                                                @endif

                                            @else
                                                {!! Form::open(['url' => route('order-store', ['shipment' => $value->id])]) !!}
                                                {!! Form::button('<i class="fas fa-plane"></i>', ['class' => 'view-btn', 'type' => 'submit', 'id' => 'sendOrder']) !!}
                                                {!! Form::close() !!}
                                            @endif


                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="20">No data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" class="text-left">
                                    {{ Form::button('send', ['class' => 'global-btn', 'id' => 'sendApi', 'disabled' => true]) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $shipments->firstItem() }}</strong> to
                                    <strong>{{ $shipments->lastItem() }} </strong> of <strong>
                                        {{ $shipments->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $shipments->links() }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
