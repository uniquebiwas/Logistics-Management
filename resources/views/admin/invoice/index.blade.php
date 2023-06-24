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
                        <a href="{{ route('invoice.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row" style="align-items: center;">
                        <div class="p-1 col-sm-1">
                            <div class="btn-group">
                                <a href="{{ route('invoice.index') }}" class="global-btn">
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
                                <th>Invoice <br> Number</th>
                                <th>Issued Date</th>
                                <th>Customer Name</th>
                                <th>AWB Date Range</th>
                                <th>Payment Status</th>
                                <th>Cancel Invoice</th>
                                <th>Payment Type</th>
                                <th style="text-align:center;" width="10%">Action</th>
                                @can('invoice-weightDifference')
                                    <th>Weight Difference<br> Invoice</th>
                                @endcan
                                <th>Documents</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $value->invoiceNumber }}
                                        @if ($value->parentInvoice->id)
                                            ({{ $value->parentInvoice->invoiceNumber }} Replicate)
                                        @endif
                                    </td>
                                    <td>{{ $value->date->format('d M Y') }}</td>
                                    <td>{{ $value->customerName }}</td>
                                    <td>
                                        {{ $value->between_awb }}
                                    </td>
                                    <td class="text-capitalize">
                                        @if (Gate::check('invoice-payment-status') && !$value->paymentStatus)
                                            {!! Form::open(['url' => route('change-invoice-payment', $value->id)]) !!}
                                            <button class="view-btn text-capitalize"
                                                type="submit">{{ $value->status }}</button>
                                            {!! Form::close() !!}
                                        @else
                                            {{ $value->status }}
                                        @endcan
                                </td>
                                <td>
                                    @can('invoice-cancel')
                                        {!! Form::open(['url' => route('cancel-invoice', ['type' => 1, 'id' => $value->id])]) !!}
                                        <button class="view-btn text-capitalize" type="submit"
                                            title="{{ $value->cancel ? 'Restore Invoice' : 'Cancel Invoice' }}"
                                            id='invoiceCancel'>{!! $value->cancel ? '<i class="fas fa-recycle"> Restore</i>' : '<i class="fas fa-ban"> Cancel</i>' !!}</button>
                                        {!! Form::close() !!}
                                    @endcan

                                </td>
                                <td class="text-capitalize">{{ $value->paymentType }}</td>
                                <td>
                                    <div class="btn-group">
                                        @can('invoice-edit')
                                            <a href="{{ route('invoice.edit', $value->id) }}" title="Edit invoice"
                                                class="view-btn mr-1"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        @can('invoice-show')
                                            <a href="{{ route('invoice.show', $value->id) }}" title="View invoice"
                                                class="view-btn mr-1" target="__blank"><i class="fas fa-print"></i></a>
                                        @endcan



                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @can('invoice-weightDifference')
                                            <a href="{{ route('overpriced-invoice', $value->id) }}"
                                                title="add weight difference charge invoice" class="view-btn mr-1"><i
                                                    class="fas fa-plus"></i></a>
                                        @endcan

                                    </div>

                                </td>
                                <td>
                                    @include('admin.invoice._documents',['value'=>$value])
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
