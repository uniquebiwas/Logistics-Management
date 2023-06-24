@extends('layouts.admin')
@section('title', 'International Manifest List')

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content intl-manifest-list">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">International Manifest List</h3>
                    <div class="card-tools">
                        <a href="{{ route('international-manifest.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="">
                                <div class=" row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools float-right">
                                @can('international-create')
                                    <a href="{{ route('international-manifest.create') }}" class="global-btn">
                                        <i class="fa fa-plus"></i> Create New Manifest</a>
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
                                <th>Manifest Number</th>
                                <th>MAWB</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>
                                    Flight Number
                                </th>
                                <th>AWB count</th>
                                <th>Date</th>
                                <th style="text-align:center;" width="10%">Action</th>
                                <th style="text-align:center;" width="10%">Download</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $value->manifest_number }}</td>
                                    <td>{{ @$value->masterAirwayBill }}</td>

                                    <td class="text-capitalize">{{ $value->origin }}</td>
                                    <td>{{ $value->clientLocation }}</td>
                                    <td>{{ $value->flightNumber }}</td>
                                    <td>{{ $value->shipment_count }}</td>
                                    <td>
                                        {{ @$value->date->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @can('international-edit')
                                                <a href="{{ route('international-manifest.edit', $value->id) }}"
                                                    title="Edit international-manifest" class="view-btn ml-1"><i
                                                        class="fas fa-edit"></i></a>
                                            @endcan


                                            @can('international-show')
                                                <a href="{{ route('international-manifest.show', $value->id) }}"
                                                    title="Show international-manifest" class="view-btn mr-1"
                                                    target="_blank"><i class="fas fa-eye">

                                                    </i></a>
                                            @endcan

                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @can('international-show')
                                                <a href="{{ route('international-manifest.show', $value->id) }}" title="pdf"
                                                    class="view-btn ml-1" download><i class="fas fa-download">

                                                    </i></a>
                                            @endcan
                                            @can('international-show')
                                                <a href="{{ route('export-manifest-excel', $value->id) }}" title="Excel file"
                                                    class="view-btn ml-1" download>
                                                    <i class="fas fa-file-excel    "></i>
                                                </a>
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
