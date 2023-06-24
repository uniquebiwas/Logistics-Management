@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title">{{ @$title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('shipmentpackages.pending') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div> --}}
                <div class="card-header">
                    <div class="row">
                        <div class="p-1 col-lg-6">
                            <form action="" class="">
                                <div class=" row">
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
                        <div class="card-tools float-right d-flex text-sm">
                            @can('zonal-create')
                                <a href="{{ route('zonal.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                    <i class="fa fa-plus"></i> Add New Shipment Zones</a>
                            @endcan
                            @can('zonal-import')
                                <a href="{{ route('zonal-import') }}" class="btn btn-dark btn-sm btn-flat mr-2">
                                    <i class="fas fa-upload    "></i> Import Zone</a>
                            @endcan
                            <a name="Download CSV" id="" class="btn btn-dark btn-sm btn-flat mr-2"
                                href="{{ route('zonal-import-export') }}" role="button">CSV example</a>
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow-x: scroll" class="card-body card-format">
                <table class="table table-bordered"> {{-- table-bordered --}}
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ZonalType</th>
                            <th>Agent Service</th>
                            <th>Total countries</th>
                            <th>Countries</th>
                            <th style="text-align:center;" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $value->zone }}
                                </td>
                                <td>
                                    {{ $value->service }}
                                </td>

                                <td>
                                    {{ $value->total }}
                                </td>
                                <td>
                                    <livewire:country :country="$value->countries" />
                                </td>
                                @php
                                    $countries = str_replace(',', '-', $value->countries);
                                @endphp
                                <td>
                                    @can('zonal-edit')
                                        <a href={{ route('zonal.bulkedit', ['serviceid' => $value->serviceagent_id, 'zoneid' => $value->zone_id, 'country_id' => $countries]) }}
                                            title="Edit zonal" class="btn btn-success btn-sm btn-flat"><i
                                                class="fas fa-edit"></i></a>

                                    @endcan
                                    {{-- @can('zonal-delete')
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['zonal.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this shipmentpackagetype?")']) }}
                                            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete Zonal ']) }}
                                            {{ Form::close() }}
                                        @endcan --}}
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
