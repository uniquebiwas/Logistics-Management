@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">{{ $title }}</h3>

                            <div class="card-tools">
                                <a href="{{ route('shipment.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                    <i class="fa fa-plus"></i>
                                    Add new shipment
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="overflow-x: scroll" class="card-body card-format">
                                <table class="table table-striped table-hover"> {{-- table-bordered --}}
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Package name </th>
                                            <th>Barcode</th>
                                            <th>Status</th>
                                            <th> Remarks</th>
                                            <th>Date</th>
                                            <th style="text-align:center;" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shipments as $key => $shipmentItem)
                                            {{-- {{ $shipmentItem }} --}}
                                            <tr>
                                                <td>{{ $key + 1 }}.</td>
                                                <td>{{ @$shipmentItem->package_name }}</td>
                                                <td>
                                                    <img src="data:image/png;base64,{{ \DNS1D::getBarcodePNG("$shipmentItem->barcode", 'CODABAR') }}"
                                                        alt="barcode" />
                                                    <br>
                                                    {{ $shipmentItem->barcode }}
                                                    <br>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge badge-{{ @$shipmentItem->package_status == 'verified' ? 'success' : 'info' }}">
                                                        {{ ucFirst(@$shipmentItem->package_status) }}
                                                    </span>
                                                </td>
                                                <td> {{ @$shipmentItem->remarks }}</td>
                                                <td>{{ ReadableDate(@$shipmentItem->created_at, 'all') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('shipment.show', $shipmentItem->id) }}"
                                                            title="View Shipment Package"
                                                            class="btn btn-primary btn-sm btn-flat"><i
                                                                class="fas fa-eye"></i></a>
                                                        @if ($shipmentItem->package_status == 'PENDING')
                                                            <a href="{{ route('shipment.edit', $shipmentItem->id) }}"
                                                                title="Edit Shipment Package" class="btn btn-success btn-sm btn-flat">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            {{ Form::open(['method' => 'DELETE', 'route' => ['shipment.destroy', $shipmentItem->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this package?")']) }}
                                                            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete Package ']) }}
                                                            {{ Form::close() }}
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="text-sm">
                                                Showing <strong>{{ $shipments->firstItem() }}</strong> to
                                                <strong>{{ $shipments->lastItem() }} </strong> of <strong>
                                                    {{ $shipments->total() }}</strong>
                                                entries
                                                <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b>
                                                    seconds to
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
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
