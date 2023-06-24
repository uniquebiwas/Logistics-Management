@extends('layouts.admin')
@section('title', 'Staff Management')
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a name="Create Staff" id="" class="btn btn-default" href="{{ route('agent-staff.create') }}"
                                role="button">Create Staff</a>
                        </div>
                        <div class="card-body search-body">
                            <h3 class="card-title">Staff List</h3>
                            <div class="card-tools">
                                <form action="" method="get" class="d-flex" autocomplete="off">
                                    <input type="text" name="keyword" class="form-control form-control-sm mr-2"
                                        value="{{ request()->keyword }}">
                                    <input type="date" name="startDate" class="form-control form-control-sm  mr-2"
                                        title="start Date" value="{{ request()->startDate }}">
                                    <input type="date" name="endDate" id="" class="form-control form-control-sm mr-2"
                                        title="End Date" value="{{ request()->endDate }}">
                                    <button type="submit" class="view-btn"><i
                                            class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Status</th>
                                        <th style="text-align:center;" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($staff as $key=>$item)
                                        <tr>
                                            <td>{{ $key + 1 }}.</td>
                                            <td>{{ $item->name['en'] }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->publish_status == true)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">Inactive</span>

                                                @endif
                                            </td>
                                            <td>
                                                {{-- @can('agent-staff-show')
                                                    <a href="{{ route('agent-staff.show', $item->id) }}" title="show User"
                                                        class="btn btn-success btn-sm btn-flat"><i
                                                            class="fas fa-eye    "></i></a>
                                                @endcan --}}
                                                @can('agent-staff-show')
                                                    <a href="{{ route('agent-staff.edit', $item->id) }}" title="show User"
                                                        class="btn btn-dark btn-sm btn-flat">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-capitalize">No Data Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="text-sm">
                                            Showing <strong>{{ $staff->firstItem() }}</strong> to
                                            <strong>{{ $staff->lastItem() }} </strong> of <strong>
                                                {{ $staff->total() }}</strong> entries
                                            <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b>
                                                seconds to render</span>
                                        </p>
                                    </div>
                                    <div class="col-md-8">
                                        <span class="pagination-sm m-0 float-right">{{ $staff->links() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
