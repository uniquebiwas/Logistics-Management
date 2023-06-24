@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('membership.index') }}" type="button" class="btn btn-tool">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::select('status', ['1' => 'Active', '0' => 'InActive'], @request()->status, ['class' => 'form-control form-control-sm', 'placeholder' => 'Select Status']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'btn btn-primary btn-flat btn-sm', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools float-right">
                                @can('membership-create')
                                    <a href="{{ route('membership.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                        <i class="fa fa-plus"></i> Add Package</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Package Title</th>
                                <th>Amount</th>
                                <th>Maximum Request/Year</th>
                                <th>Status</th>
                                <th>Updated</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $key => $value)


                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->title['en'] }}</td>
                                    <td>{{ $value->package_amount }}</td>
                                    <td>{{ $value->yearly_max_request }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $value->publishStatus == 0 ? 'danger' : 'success' }}">
                                            {{ $value->publishStatus == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $value->updated_at ? @$value->updated_at->format('Y-m-d') : '' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- <a href="{{ route('membership.show', $value->id) }}"
                                                title="View Detail"><button class="btn btn-primary btn-sm btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </a> --}}
                                            @can('user-edit')
                                                <a href="{{ route('membership.edit', $value->id) }}" title="Edit User"
                                                    class="btn btn-success btn-sm btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('user-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['membership.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Package?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete Package']) }}
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
                                    Showing <strong>{{ $packages->firstItem() }}</strong> to
                                    <strong>{{ $packages->lastItem() }} </strong> of <strong>
                                        {{ $packages->total() }}</strong> entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $packages->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
