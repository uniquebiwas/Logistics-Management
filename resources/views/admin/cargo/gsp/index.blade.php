@extends('layouts.admin')
@section('title', 'Generalized System Of  Preference ')

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Generalized System Of  Preference List</h3>
                    <div class="card-tools">
                        <a href="{{ route('gsp.index') }}" type="button" class="btn btn-tool">
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
                                @can('gsp-create')
                                    <a href="{{ route('gsp.create') }}" class="global-btn">
                                        <i class="fas fa-plus    "></i>
                                        create new</a>
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
                                <th>reference_no</th>
                                <th>Exporter </th>
                                <th>created at</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gsp as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $value->reference_no }}</td>
                                    <td>{{ $value->exporter_details }}</td>
                                    <td>
                                        {{ $value->created_at }}
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            @can('gsp-view')
                                                <a href="{{ route('gsp.show', $value->id) }}" title="view ncc"
                                                    class="view-btn mr-1">
                                                    <i class="fas fa-eye    "></i>
                                                </a>
                                            @endcan
                                            @can('gsp-edit')
                                                <a href="{{ route('gsp.edit', $value->id) }}" title="edit ncc"
                                                    class="view-btn mr-1">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            @endcan

                                            @can('gsp-delete')
                                            {{ Form::open(['method' => 'DELETE', 'route' => ['gsp.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this?")']) }}
                                            {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Delete?? ']) }}
                                            {{ Form::close() }}
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $gsp->firstItem() }}</strong> to
                                    <strong>{{ $gsp->lastItem() }} </strong> of <strong>
                                        {{ $gsp->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $gsp->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
