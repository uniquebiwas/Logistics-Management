@extends('layouts.admin')
@section('title', 'Invoice')
@push('scripts')
    <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('button.paymentStatus').on('click', function() {
                var confirm = window.confirm("Are you sure to change this status??");
                if (!confirm) {
                    return;
                }
                invoice = $(this).data('id');
                url = "{{ route('change-invoice-payment',':invoice') }}";
                axios.post(url, {
                        invoiceId: invoice
                    }).then(function(response) {
                        toastr.success(response.data)
                        location.reload();
                    })
                    .catch(function(error) {
                        toastr.error(response.data)
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
                    <h3 class="card-title">Invoice List</h3>
                    <div class="card-tools">
                        <a href="{{ route('invoice.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row" style="align-items: center;">
                        <div class="p-1 col-lg-2">
                            <div class="btn-group">
                                <a href="{{ route('invoice.index') }}" class="global-btn">
                                    <i class="fas fa-sync-alt fa-sm"></i> Refresh
                                </a>
                            </div>
                        </div>
                        <div class="p-1 col-lg-7">
                            <form action="" class="">
                                <div class=" row" style="align-items: center;">
                                    <div class="p-1 col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="p-1 col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::select('paymentStatus', ['0' => 'unpaid', '1' => 'paid'], request()->paymentStatus, ['class' => 'form-control form-control-sm', 'placeholder' => 'All']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <button class="global-btn"><i class="fa fa fa-search"></i>
                                            Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-3">
                            <div class="card-tools">
                                @can('invoice-create')
                                    <a href="{{ route('invoice.create') }}" class="global-btn">
                                        <i class="fa fa-plus"></i> Add New invoice</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-capitalize">
                                <th style="width: 10px">S.n</th>
                                <th>Invoice Number</th>
                                <th>customer Account </th>
                                <th>Customer Name</th>
                                <th>Payment Status</th>
                                <th>Payment Type</th>
                                <th style="text-align:center;" width="10%">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>#{{ $value->invoiceNumber }}
                                        @if ($value->parentInvoice->id)
                                            ( #{{ $value->parentInvoice->id }} Replicate)
                                        @endif
                                    </td>
                                    <td>{{ $value->customerAccount }}</td>
                                    <td>{{ $value->customerName }}</td>
                                    <td>
                                        @if (Gate::check('invoice-payment-status') && !$value->paymentStatus)
                                            <button class="view-btn paymentStatus"
                                                data-id="{{ $value->id }}">{{ $value->status }}</button>
                                        @else
                                            {{ $value->status }}
                                        @endcan
                                </td>
                                <td>{{ $value->paymentType }}</td>
                                <td>
                                    <div class="btn-group">
                                        @can('invoice-edit')
                                            <a href="{{ route('invoice.edit', $value->id) }}" title="Edit invoice"
                                                class="view-btn mr-1"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        @can('invoice-show')
                                            <a href="{{ route('invoice.show', $value->id) }}" title="View invoice"
                                                class="view-btn mr-1"><i class="fas fa-print"></i></a>
                                        @endcan
                                        <a href="{{ route('invoice.documents', $value->id) }}" title="Upload Document"
                                            class="view-btn mr-1"><i class="fas fa-upload"></i></a>
                                    </div>
                                </td>

                            </tr>

                        @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
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
