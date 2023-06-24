@extends('layouts.admin')
@section('title', 'testimonial')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">testimonial List</h3>
                    <div class="card-tools">
                        <a href="{{ route('testimonial.index') }}" type="button" class="btn btn-tool">
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
                            @can('testimonial-create')
                                <a href="{{ route('testimonial.create') }}" class="global-btn">
                                    <i class="fa fa-plus"></i> Add New Testimonial</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow-x: scroll" class="card-body">
                <table class="table table-bordered"> {{-- table-bordered --}}
                    <thead>
                        <tr>
                            <th style="width: 10px">S.N</th>
                            <th>Name</th>
                            <th>Image </th>
                            <th>Status</th>
                            <th style="text-align:center;" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $value->title }}</td>
                                <td>
                                    <img src="{{ $value->image }}"
                                        alt="{{ @$value->title }}" class="img img-thumbail" style="width:60px">
                                </td>

                                <td>
                                    <span class="badge badge-{{ $value->publish_status == '1' ? 'success' : 'danger' }}">
                                        {{ $value->publish_status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        @can('testimonial-edit')
                                            <a href="{{ route('testimonial.edit', $value->id) }}" title="Edit Testimonial"
                                                class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('testimonial-delete')
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['testimonial.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Testimonial?")']) }}
                                            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete Testimonial ']) }}
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
