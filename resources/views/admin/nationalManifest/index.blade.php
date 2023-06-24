@extends('layouts.admin')
@section('title', 'National Manifest')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">National Manifest List</h3>
                    <div class="card-tools">
                        <a href="{{ route('national-manifest.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row" style="align-items: center;">
                        <div class="p-1 col-lg-2">
                            <div class="btn-group">
                                <a href="{{ route('national-manifest.index') }}" class="global-btn">
                                    <i class="fas fa-sync-alt fa-sm"></i> Refresh
                                </a>
                            </div>
                        </div>
                        <div class="p-1 col-lg-6">
                            <form action="" class="___class_+?16___">
                                <div class="row" style="align-items: center;">
                                    <div class="p-1 col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <button class="global-btn"><i class="fa fa fa-search"></i>
                                            Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4 text-right">
                            <div class="card-tools d-inline">
                                @can('national-manifest-create')
                                    @include('admin.nationalManifest.modal')
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
                                <th>National Manifest Number</th>
                                <th>Date </th>
                                <th>AWB Count</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>#{{ $value->manifestNumber }}</td>
                                    <td>{{ $value->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $value->shipment_count }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('national-manifest-edit')
                                                <a href="{{ route('national-manifest.edit', $value->id) }}"
                                                    title="Edit manifest" class="view-btn mr-1">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            @endcan

                                            @can('national-manifest-show')
                                                <a href="{{ route('national-manifest.show', $value->id) }}"
                                                    title="Show manifest" class="view-btn mr-1" target="_blank"><i
                                                        class="fas fa-eye"></i></a>
                                            @endcan
                                            @can('national-manifest-show')
                                                <a href="{{ route('national-manifest.show', $value->id) }}"
                                                    title="Show manifest" class="view-btn mr-1" target="_blank"><i
                                                        class="fas fa-download"></i></a>
                                                <a href="{{ route('nationalManifestExport', $value->id) }}" title="Excel file"
                                                    class="view-btn mr-1">
                                                    <i class="fas fa-file-excel "></i>
                                                </a>

                                            @endcan
                                            @can('national-manifest-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['national-manifest.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this manifest?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete manifest ']) }}
                                                {{ Form::close() }}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $sum += $value->wholeTotal;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><b>Total</b></td>
                                <td class="text-capitalize">{{ $format->format($sum) }}</td>
                            </tr>
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
