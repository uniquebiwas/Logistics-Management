@extends('layouts.admin')
@section('title', @$title)
@push('scripts')
@endpush
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username text-capitalize">{{ $user->name['en'] }}</h3>
                            <h5 class="widget-user-desc">{{ $user->roles->first()->name }}</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                src="{{ $user->profileImage ?? asset('/images/placeholder.png') }}" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $user->email }}</h5>
                                        <span class="">Email</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $user->created_at->diffForHumans() }}</h5>
                                        <span class="">Registered At</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">
                                            @if ($user->publish_status)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Inactive</span>

                                            @endif
                                        </h5>
                                        <span class="">Status</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
