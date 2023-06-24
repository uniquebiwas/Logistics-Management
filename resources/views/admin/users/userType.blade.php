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
                <div class="card-header">
                    <div class="btn-group">
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-flat btn-sm">
                            <i class="fas fa-sync-alt fa-sm"></i> Refresh
                        </a>
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-sm btn-flat mr-2">
                            <i class="fa fa-plus"></i> Add New User</a>
                    </div>
                </div>
                <div class="card-body card-format">
                    <table class="table table-striped table-hover"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th style="width: 40px">Label</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key =>$user)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $user->user->name['en'] }}</td>
                                    <td>

                                    </td>
                                    <td></td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan=6>No user available</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-sm">
                                    Showing <strong>{{ $users->firstItem() }}</strong> to
                                    <strong>{{ $users->lastItem() }} </strong> of <strong> {{ $users->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $users->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
