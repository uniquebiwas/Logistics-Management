@extends('layouts.admin')
@section('title', $title)
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username">{{ @$profile->name['en'] }}</h3>
                            <h5 class="widget-user-desc">Agent</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                src="{{ @$profile->profileImage ?? asset('/images/placeholder.png') }}"
                                alt="{{ @$profile->name['en'] }}">
                        </div>
                        <div class="card-footer bg-white">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone Verified</b> <a class="float-right @if ($profile->phoneVerifiedAt) text-success @else text-warning @endif">
                                        @if ($profile->phoneVerifiedAt) <i
                                            class="fas fa-check"></i>@else <i class="fas fa-window-close"></i>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email Verified</b> <a class="float-right @if ($profile->emailVerifiedAt) text-success @else text-warning @endif">
                                        @if ($profile->emailVerifiedAt) <i
                                            class="fas fa-check"></i>@else <i class="fas fa-window-close"></i>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Document Verified</b> <a class="float-right @if ($profile->documentVerifiedAt) text-success @else text-warning @endif">
                                        @if ($profile->documentVerifiedAt) <i
                                            class="fas fa-check"></i>@else <i class="fas fa-window-close"></i>
                                        @endif
                                    </a>
                                </li>

                                <li class="list-group-item">
                            <a class="btn btn-dark" href="{{ route('agentEditProfile') }}" role="button">
                            <i class="fa fa-recycle"></i> Update Profile
                            </a>
                                </li>
                            </ul>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2 d-flex">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile"
                                        data-toggle="tab">Profile</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#company" data-toggle="tab">Company</a>
                                </li>
                            </ul>

                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <!-- About Me Box -->
                                    <div class="card card-primary text-center">
                                        <div class="card-header widget-user-header bg-info">
                                            <h3 class="widget-user-username">{{ @$profile->name['en'] }}
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body text-left">
                                            <div class="col-6 float-left">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Email:
                                                        {{ @$profile->email }}</li>
                                                    @if (@$profile->tempAddress)
                                                        <li class="list-group-item">Temporary Address: <a
                                                                href="{{ @$profile->tempAddress }}"></a>
                                                            {{ @$profile->tempAddress }} </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-6 float-right">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Phone:
                                                        {{ @$profile->mobile ?? 'N/A' }}</li>
                                                    @if (@$profile->permanentAddress)
                                                        <li class="list-group-item">Permanent Address: <a
                                                                href="{{ @$profile->permanentAddress }}"></a>
                                                            {{ @$profile->permanentAddress }} </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->

                                </div>
                                <div class="tab-pane" id="company">

                                    <!-- About Me Box -->
                                    <div class="card card-primary text-center">
                                        <div class="card-header widget-user-header bg-info">
                                            <h3 class="widget-user-username">{{ @$profile->agent_profile->company_name }}
                                            </h3>
                                        </div>
                                        <div class="widget-user-image mt-2">
                                            <img class="img-circle elevation-2 img-responsive"
                                                src="{{ @$profile->agent_profile->company_logo_url ?? asset('/images/placeholder.png') }}"
                                                alt="{{ @$profile->agent_profile->company_name }}" width="20%">
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body text-left">
                                            <div class="col-6 float-left">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Company Name:
                                                        {{ @$profile->agent_profile->company_name }}</li>
                                                    <li class="list-group-item">Address:
                                                        {{ @$profile->agent_profile->address }}</li>
                                                    <li class="list-group-item">City:
                                                        {{ @$profile->agent_profile->city }}
                                                    </li>
                                                    @if (@$profile->agent_profile->facebook)
                                                        <li class="list-group-item">Facebook Link: <a
                                                                href="{{ @$profile->agent_profile->facebook }}"></a>
                                                            {{ @$profile->agent_profile->facebook }} </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-6 float-right">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"> Designation:
                                                        {{ @$profile->agent_profile->designation }} </li>
                                                    <li class="list-group-item">State:
                                                        {{ @$profile->agent_profile->state }}</li>
                                                    <li class="list-group-item">Country:
                                                        {{ @$profile->agent_profile->get_country->name }}</li>
                                                    @if (@$profile->agent_profile->twitter)
                                                        <li class="list-group-item">Twitter Link: <a
                                                                href="{{ @$profile->agent_profile->twitter }}"></a>
                                                            {{ @$profile->agent_profile->twitter }} </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
