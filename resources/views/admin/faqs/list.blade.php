@extends('layouts.admin')
@section('title', 'Faqs')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Faqs List</h3>
                    <div class="card-tools">
                        <a href="{{ route('faq.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="p-1 col-lg-7">
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control', 'placeholder' =>
                                        'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <button class="btn btn-primary btn-flat"><i class="fa fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-3">
                            <div class="card-tools">
                                @can('faq-create')
                                <a href="{{ route('faq.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                                    <i class="fa fa-plus"></i> Add New FAQ</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover"> {{-- table-bordered--}}
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Faq Question</th>
                                <th>Status</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$value)
                            <tr>
                              <td>{{$key+1}}.</td>
                              <td>{{ $value->title }}</td>

                              <td>
                                <span class="badge badge-{{ $value->publish_status=='1' ?'success':'danger' }}">
                                {{ $value->publish_status=='1'?'Active':'Inactive' }}
                                </span>
                              </td>

                              <td>
                                <div class="btn-group">
                                  @can('faq-edit')
                                  <a href="{{route('faq.edit',$value->id)}}" title="Edit Faq" class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                  @endcan
                                  @can('faq-delete')
                                  {{Form::open(['method' => 'DELETE','route' => ['faq.destroy', $value->id],'style'=>'display:inline','onsubmit'=>'return confirm("Are you sure you want to delete this Faq?")']) }}
                                  {{Form::button('<i class="fas fa-trash-alt"></i>',['class'=>'btn btn-danger btn-sm btn-flat','type'=>'submit','title'=>'Delete Faq '])}}
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
                                  Showing <strong>{{ $data->firstItem() }}</strong>  to <strong>{{ $data->lastItem() }} </strong>  of <strong> {{$data->total()}}</strong> entries
                                  <span> | Takes <b>{{ round((microtime(true) - LARAVEL_START),2) }}</b> seconds to render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{$data->links()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection