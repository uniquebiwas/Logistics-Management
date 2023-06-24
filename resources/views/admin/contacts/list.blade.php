@extends('layouts.admin')
@section('title', 'Contact')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact List</h3>
                    <div class="card-tools">
                        <a href="{{ route('contact.index') }}" type="button" class="btn btn-tool">
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
                            @can('Contact-create')
                                <a href="{{ route('contact.index') }}" class="global-btn">
                                    Refresh</a>
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
                            <th>Email </th>
                            <th>Phone </th>
                            <th>Status</th>
                            <th style="text-align:center;" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>
                                    <span class="badge badge-{{ $value->view_status == '1' ? 'success' : 'danger' }}">
                                        {{ $value->view_status == '1' ? 'Seen' : 'Pending' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        @can('contact-view')
                                            <a href="{{ route('contact.show', $value->id) }}" title="view Contact"
                                                class="view-btn mr-1">
                                                <i class="fas fa-eye    "></i>
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
