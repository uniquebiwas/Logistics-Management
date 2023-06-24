@extends('layouts.admin')
@section('title', 'location')
@section('content')
    @include('admin.section.notify')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-capitalize">{{ strToLower(request()->type) }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('location.index', ['type' => request()->type]) }}" type="button"
                            class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="">
                                <div class=" row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <button class="view-btn"><i class="fa fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools float-right">
                                @can('location-create')
                                    <a href="{{ route('location.create', ['type' => request()->type]) }}"
                                        class="global-btn">
                                        <i class="fa fa-plus"></i> Add New {{ strToLower(request()->type) }}</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-bordered"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">S.N</th>
                                <th>{{ strToLower(request()->type) }}</th>
                                <th>created at</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locationIndex as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $value->title }}</td>
                                    <td>
                                        {{ $value->created_at->diffForHumans() }}
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            @can('location-edit')
                                                <a href="{{ route('location.edit', ['location' => $value->id, 'type' => request()->type]) }}"
                                                    title="Edit {{ strToLower(request()->type) }}" class="view-btn mr-1"><i
                                                        class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('location-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['location.destroy', ['type' => request()->type, 'location' => $value->id]], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Service?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete ' . strToLower(request()->type)]) }}
                                                {{ Form::close() }}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $locationIndex->firstItem() }}</strong> to
                                    <strong>{{ $locationIndex->lastItem() }}
                                    </strong> of <strong> {{ $locationIndex->total() }}</strong> entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $locationIndex->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
