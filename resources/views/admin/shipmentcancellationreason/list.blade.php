@extends('layouts.admin')
@section('title', 'Shipment Cancellation Reason')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Shipment Cancellation Reason List</h3>
                    <div class="card-tools">
                        <a href="{{ route('shipmentcancellationreason.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'btn btn-primary btn-flat btn-sm', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools float-right">
                                @can('shipmentcancellationreason-create')
                                    <a href="{{ route('shipmentcancellationreason.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                        <i class="fa fa-plus"></i> Add New Reason</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Reason Title</th>
                                <th>Usage</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                {{-- {{ dd($value->image) }} --}}
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->title }}</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ $value->usage_by == true ? 'Admin' : 'Agent' }}
                                        </span>
                                    </td>
                                    <td>{{ ReadableDate(@$value->created_at, 'all') }}</td>
                                    <td>{{ ReadableDate(@$value->updated_at, 'all') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $value->publishStatus == true ? 'success' : 'danger' }}">
                                            {{ $value->publishStatus == true ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            @can('shipmentcancellationreason-edit')
                                                <a href="{{ route('shipmentcancellationreason.edit', $value->id) }}" title="Edit shipmentcancellationreason"
                                                    class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('shipmentcancellationreason-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['shipmentcancellationreason.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this shipmentcancellationreason?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete shipmentcancellationreason ']) }}
                                                {{ Form::close() }}
                                            @endcan
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
                                    Showing <strong>{{ $data->firstItem() }}</strong> to
                                    <strong>{{ $data->lastItem() }} </strong> of <strong> {{ $data->total() }}</strong>
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
