@extends('layouts.admin')
@section('title', 'Benefit')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Benefit  List</h3>
                    <div class="card-tools">
                        <a href="{{ route('benefit.index') }}" type="button" class="btn btn-tool">
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
                            @can('benefit-create')
                                <a href="{{ route('benefit.create') }}" class="global-btn">
                                    <i class="fa fa-plus"></i> Add New Benefit</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow-x: scroll" class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">S.N</th>
                            <th>Title</th>
                            <th>Featured Image</th>
                            <th>Status</th>
                            <th style="text-align:center;" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($benifits as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $value->title }}</td>
                                <td>
                                    <img src="{{ @$value->image }}" alt="{{ @$value->title }}"
                                        class="img img-thumbail" style="width:60px">
                                </td>


                                <td>
                                    <span class="badge badge-{{ $value->publishStatus == '1' ? 'success' : 'danger' }}">
                                        {{ $value->publishStatus == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        @can('benefit-edit')
                                            <a href="{{ route('benefit.edit', $value->id) }}" title="Edit Service"
                                                class="view-btn mr-1"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('benefit-delete')
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['benefit.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Service?")']) }}
                                            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete benefit ']) }}
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
                                Showing <strong>{{ $benifits->firstItem() }}</strong> to
                                <strong>{{ $benifits->lastItem() }} </strong> of <strong>
                                    {{ $benifits->total() }}</strong>
                                entries
                                <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                    render</span>
                            </p>
                        </div>
                        <div class="col-md-8">
                            <span class="pagination-sm m-0 float-right">{{ $benifits->links() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
