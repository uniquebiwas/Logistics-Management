@extends('layouts.admin')
@section('title', 'Invoice')
@push('scripts')
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Invoice List</h3>
                    <div class="card-tools">
                        <a href="{{ route('cargo-invoice.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row" style="align-items: center;">
                        <div class="p-1 col-lg-1">
                            <div class="btn-group">
                                <a href="{{ route('cargo-invoice.index') }}" class="global-btn">
                                    <i class="fas fa-sync-alt fa-sm"></i> Refresh
                                </a>
                            </div>
                        </div>
                        <div class="p-1 col-lg-9">
                            <form action="" class="">
                                <div class=" row" style="align-items: center;">
                                <div class="p-1 col-lg-2 col-md-2 col-sm-2">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Invoice Number']) !!}
                                    </div>
                                    <div class="p-1 col-lg-2 col-md-2 col-sm-2">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Customer Name']) !!}
                                    </div>
                                    <div class="p-1 col-lg-2 col-md-2 col-sm-2">
                                        {!! Form::date('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Issue Date']) !!}
                                    </div>
                                    <div class="p-1 col-lg-2 col-md-2 col-sm-2">
                                        {!! Form::select('paymentStatus', ['0' => 'unpaid', '1' => 'paid'], request()->paymentStatus, ['class' => 'form-control form-control-sm', 'placeholder' => 'All']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <button class="global-btn"><i class="fa fa fa-search"></i>
                                            Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-2 text-right">
                            <div class="card-tools">
                                @can('cargo-invoice-create')
                                    <a href="{{ route('cargo-invoice.create') }}" class="global-btn">
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
                                <th>Issued Date </th>
                                <th>Customer Name</th>
                                <th>AWB Date Range</th>
                                <th>Payment Status</th>
                                <th>Payment Type</th>
                                <th>Cancel</th>
                                <th style="text-align:center;" width="10%">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($invoices as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $value->invoiceNumber }}

                                    </td>
                                    <td>{{ $value->date->format('d, F Y') }}</td>
                                    <td>{{ $value->customerName }}</td>
                                    <td>
                                        {{ $value->between_awb }}
                                    </td>
                                    <td class="text-capitalize">
                                        @if (Gate::check('invoice-payment-status') && !$value->paymentStatus)
                                            {!! Form::open(['url' => route('change-cargo-payment-status', $value->id)]) !!}
                                            <button class="view-btn text-capitalize"
                                                type="submit">{{ $value->status }}</button>
                                            {!! Form::close() !!}
                                        @else
                                            {{ $value->status }}
                                        @endcan
                                </td>

                                <td class="text-capitalize">{{ $value->paymentType }}</td>
                                <td> @can('cargo-invoice-cancel')
                                        {!! Form::open(['url' => route('cancel-invoice', ['type' => 2, 'id' => $value->id])]) !!}
                                        <button class="view-btn text-capitalize" type="submit"
                                            title="{{ $value->cancel ? 'Restore Invoice' : 'Cancel Invoice' }}"
                                            id='invoiceCancel'>{!! $value->cancel ? '<i class="fas fa-recycle"> Restore</i>' : '<i class="fas fa-ban"> Cancel</i>' !!}</button>
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @can('cargo-invoice-edit')
                                            <a href="{{ route('cargo-invoice.edit', $value->id) }}" title="Edit invoice"
                                                class="view-btn mr-1"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        @can('cargo-invoice-show')
                                            <a href="{{ route('cargo-invoice.show', $value->id) }}" title="View invoice"
                                                class="view-btn mr-1" target="__blank"><i class="fas fa-print"></i></a>
                                        @endcan





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
                                Showing <strong>{{ $invoices->firstItem() }}</strong> to
                                <strong>{{ $invoices->lastItem() }} </strong> of <strong>
                                    {{ $invoices->total() }}</strong>
                                entries
                                <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                    render</span>
                            </p>
                        </div>
                        <div class="col-md-8">
                            <span class="pagination-sm m-0 float-right">{{ $invoices->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
