@extends('layouts.admin')
@section('title', 'Zone List')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Zone List</h3>
                    <div class="card-tools">
                        <a href="{{ route('shipmentzone.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-10">
                            <form action="">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::select('serviceAgentId', $serviceAgents, request()->serviceAgentId, ['class' => 'form-control form-control-sm']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2">
                            <div class="card-tools">
                                @can('shipmentzone-create')
                                    <a href="{{ route('shipmentzone.create') }}" class="global-btn mr-1">
                                        <i class="fa fa-plus"></i> Add Zone</a>
                                @endcan
                            </div>
                        </div>

                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">S.n</th>
                                <th>Title</th>
                               <th>Service Provider </th>
                                <th>Status</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->title }}</td>
                                    <td>{{ $value->serviceAgent->title }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $value->publishStatus == true ? 'success' : 'danger' }}">
                                            {{ $value->publishStatus == true ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @can('shipmentzone-edit')
                                                <a href="{{ route('shipmentzone.edit', $value->id) }}"
                                                    title="Edit shipmentzone" class="view-btn mr-2"><i
                                                        class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('shipmentzone-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['shipmentzone.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this shipmentzone?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete shipmentzone ']) }}
                                                {{ Form::close() }}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
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
