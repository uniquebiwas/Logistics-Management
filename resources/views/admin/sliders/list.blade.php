@extends('layouts.admin')
@section('title', 'Sliders')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sliders List</h3>
                    <div class="card-tools">
                        <a href="{{ route('slider.index') }}" type="button" class="btn btn-tool">
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
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    {!! Form::select('slider_type', SLIDER_TYPE, @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Type']) !!}
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                </div>
                        </div>
                        </form>
                    </div>
                    <div class="p-1 col-lg-4">
                        <div class="card-tools float-right">
                            @can('slider-create')
                                <a href="{{ route('slider.create') }}" class="global-btn">
                                    <i class="fa fa-plus"></i> Add Slider</a>
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
                            <th>Slider</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th style="text-align:center;" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                            {{-- {{ dd($value->image) }} --}}
                            <tr>
                                <td>{{ $key + 1 }}.</td>
                                <td>{{ @$value->title['en'] }} - {{ @$value->title['np'] }}</td>
                                <td>
                                    <img src="{{ asset('uploads/photos/thumbs/' . @$value->image) }}"
                                        alt="{{ @$value->title['en'] }}" class="img img-thumbail" style="width:60px">
                                </td>
                                <td>
                                    {{ @$value->slider_type }}
                                </td>

                                <td>
                                    <span class="badge badge-{{ $value->publish_status == '1' ? 'success' : 'danger' }}">
                                        {{ $value->publish_status == '1' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="btn-group">
                                        @can('slider-edit')
                                            <a href="{{ route('slider.edit', $value->id) }}" title="Edit Slider"
                                                class="view-btn mr-1"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('slider-delete')
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['slider.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Slider?")']) }}
                                            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete Slider ']) }}
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
                                <strong>{{ $data->lastItem() }} </strong> of <strong> {{ $data->total() }}</strong>
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
