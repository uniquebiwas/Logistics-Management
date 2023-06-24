@extends('layouts.admin')
@section('title', 'Transaction History')
@push('scripts')

@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Credit Transaction History</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>AWB</th>
                                <th>barcode</th>
                                <th>Credit Usage</th>
                                <th>Used Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($history as $key=>$item)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $item->shipmentPackage->barcode }}</td>
                                    <td> <img
                                            src="data:image/png;base64,{{ \DNS1D::getBarcodePNG($item->shipmentPackage->barcode, 'C39', 1, 36) }}"
                                            alt="barcode" /></td>
                                    <td>
                                        {{ $item->shipping_charge }}
                                    </td>
                                    <td>{{ $item->created_at->toDateTimeString() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-capitalize">No History Found</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer p-1">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $history->firstItem() }}</strong> to
                                    <strong>{{ $history->lastItem() }} </strong> of <strong>
                                        {{ $history->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $history->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
