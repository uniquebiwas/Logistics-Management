@extends('layouts.admin')
@section('title', $title)
@push('scripts')

@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <div class="container-fluid">
        <div class="b-noti-col">
            <div class="b-noti-btn">
                <div class="b-noti-left common-btns">
                    @canany(['uploading-list', 'uploading-create', 'uploading-edit', 'uploading-delete', 'uploading-show'])
                        <a href="{{ route('export.create') }}" class="global-btn">Export New CSV</a>
                    @endcanany
                </div>

            </div>
        </div>
    </div>
    <section class="content export-list">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }} List</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="___class_+?14___">
                                <div class="row">

                                    <div class="col">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col">
                                        {!! Form::date('startDate', @request()->startDate, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col">
                                        {!! Form::date('endDate', @request()->endDate, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered" id="table1"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">S.n</th>
                                <th>Title</th>
                                <th>AWB Count</th>
                                <th>Generated At</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>


                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->title }}</td>
                                    <td>
                                        @if (gettype($value->shipment_ids) == 'array')
                                        {{ count($value->shipment_ids) }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>{{ ReadableDate(@$value->created_at, 'ymd') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('export.show', $value->id) }}"
                                                title="View Export CSV Detail" class="view-btn mr-1">
                                                <i class="fas fa-eye"></i></a>
                                            {!! Form::open(['url' => route('redownloadCSV', $value->id)]) !!}
                                            <button title="View Export CSV Detail" class="view-btn" type="submit">
                                                <i class="fas fa-download "></i>
                                            </button>
                                            {!! Form::close() !!}
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
