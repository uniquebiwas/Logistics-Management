@extends('layouts.admin')
@section('title', @$title)
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('pricing.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-5">
                            <form action="" class="___class_+?12___">
                                <div class="row">
                                    <div class="col-lg-8 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-7">
                            <div class="card-tools float-right">

                                @can('pricing-create')
                                    @if (request()->is('nd-admin/agent-pricing'))
                                        <a href="{{ route('admin.pricing.agent.create') }}"
                                            class="btn btn-success btn-sm btn-flat mr-2">
                                            <i class="fa fa-plus"></i> New Agent Pricing</a>
                                        <a href="{{ route('import-shipment-zone') }}"
                                            class="btn btn-warning btn-sm btn-flat mr-2">
                                            <i class="fas fa-file-import"></i> Import Excel</a>
                                    @else
                                        <a href="{{ route('pricing.create') }}" class="global-btn">
                                            <i class="fa fa-plus"></i> New Pricing</a>
                                    @endif
                                    <a name="Download CSV" id="" class="global-btn"
                                        href="{{ route('import-shipment-zone-download') }}" role="button">CSV format</a>

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
                                @if (request()->is('nd-admin/agent-pricing'))
                                    <th>Local Agent</th>
                                @endif
                               <th>Service Provider </th>
                                <th>Countries</th>
                                <th>Weight (in KGs) & Price</th>
                                {{-- <th>Status</th> --}}
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                {{-- {{ dd(@$value->getWeightPrice) }} --}}
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    @if (request()->is('nd-admin/agent-pricing'))
                                        <th>{{ @$value->getLocalAgent->name['en'] }}</th>
                                    @endif
                                    <td>{{ @$value->getAgent->title }}</td>
                                    <td>{{ $value->zone_id ? $value->getZone->title : $value->getCountry->name }}</td>
                                    <td>

                                        <table class="table table-striped table-hover"> {{-- table-bordered --}}
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Weight</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($value->getWeightPrice as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}.</td>
                                                        <th>{{ @$item->weight }}</th>
                                                        <th>{{ @$item->price }}</th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @can('pricing-edit')
                                                @if (request()->is('nd-admin/agent-pricing'))
                                                    <a href="{{ route('admin.pricing.agent.edit', $value->id) }}"
                                                        title="Edit pricing" class="btn btn-success btn-sm btn-flat"><i
                                                            class="fas fa-edit"></i></a>
                                                @else
                                                    <a href="{{ route('pricing.edit', $value->id) }}" title="Edit pricing"
                                                        class="btn btn-success btn-sm btn-flat"><i
                                                            class="fas fa-edit"></i></a>
                                                @endif
                                            @endcan
                                            @can('pricing-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['pricing.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this pricing?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete pricing ']) }}
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
