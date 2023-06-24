@extends('layouts.admin')
@section('title', 'List Users')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User List</h3>
                    <div class="card-tools">
                        <a href="{{ route('users.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="{{ route('users.index') }}" class="global-btn">
                                    <i class="fas fa-sync-alt fa-sm"></i> Refresh
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-tools" style="float:right;">
                                @can('user-create')
                                <a href="{{ route('users.create') }}" class="global-btn">
                                    <i class="fa fa-plus"></i> Add New User</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">S.n</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Role</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$value)

                            {{-- @if($value $userRole ) --}}
                            <tr>
                              <td>{{$key+1}}.</td>
                              <td>{{ @$value->name['np'] }}</td>
                              <td>{{ $value->email }}</td>
                              <td>
                                @if(!empty($value->getRoleNames()))
                                    @foreach($value->getRoleNames() as $v)
                                        <label class="badge badge-primary">{{ $v }}</label>
                                    @endforeach
                                @endif
                              </td>

                              <td>
                                <span class="badge badge-{{ $value->publish_status==0 ?'danger':'success' }}">
                                {{ $value->publish_status==1?'Active':'Inactive' }}
                                </span>
                              </td>
                              <td>{{ $value->updated_at ? @$value->updated_at->format('Y-m-d') : ''}}</td>
                              <td>
                                <div class="btn-group">
                                  <a href="{{route('users.show',$value->id)}}" title="View Detail"><button class="view-btn mr-1"><i class="fas fa-eye"></i></button></a>
                                  @can('user-edit')
                                  <a href="{{route('users.edit',$value->id)}}" title="Edit User" class="view-btn  mr-1"><i class="fas fa-edit"></i></a>
                                  @endcan
                                  @can('user-delete')
                                  {{Form::open(['method' => 'DELETE','route' => ['users.destroy', $value->id],'style'=>'display:inline','onsubmit'=>'return confirm("Are you sure you want to delete this User?")']) }}
                                  {{Form::button('<i class="fas fa-trash-alt"></i>',['class'=>'view-btn','type'=>'submit','title'=>'Delete User'])}}
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
