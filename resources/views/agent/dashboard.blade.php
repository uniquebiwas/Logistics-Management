@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                @if (!(request()->user()->documentVerifiedAt && request()->user()->emailVerifiedAt && request()->user()->phoneVerifiedAt))
                    <div class="card col-6">
                        <div class="card-header text-center">
                            <i class="fas fa-user-check mr-2"></i> <strong>Tasks</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item @if (request()->user()->emailVerifiedAt) text-success @else text-danger @endif">
                                <i class="fas fa-envelope mr-2"></i> Email Verification
                                @if (!request()->user()->emailVerifiedAt)
                                    <div class="float-right">
                                        {{ Form::open(['method' => 'POST', 'route' => ['agent.sendVerificationEmail', request()->user()->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to resend verification email?")']) }}
                                        {{ Form::button("<i class='fas fa-sync-alt'></i> Resend Verification Email", ['class' => 'btn btn-sm btn-warning btn-flat', 'type' => 'submit']) }}
                                        {{ Form::close() }}
                                    </div>

                                @endif
                            </li>
                            <li class="list-group-item @if (request()->user()->phoneVerifiedAt) text-success @else text-danger @endif">
                                <i class="fas fa-phone mr-2"></i>Phone Verified
                                @if (!request()->user()->phoneVerifiedAt)
                                    <div class="float-right">
                                        {!! Form::open(['url' => route('sendMobileVerifyOtp'), 'method' => 'post']) !!}
                                        @if (request()->verify_otp && request()->verify_otp == 1)
                                            {!! Form::number('otp', null, ['placeholder' => 'Enter OTP', 'class' => 'form-control form-control-sm', 'required' => true]) !!}
                                            {{ Form::button("<i class='fas fa-shield-alt'></i> Verify OTP", ['class' => 'btn btn-warning btn-sm btn-flat', 'type' => 'submit']) }}
                                        @else
                                            {{ Form::button("<i class='fas fa-sync-alt'></i> Resend OTP", ['class' => 'btn btn-warning btn-sm btn-flat', 'type' => 'submit']) }}

                                        @endif
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            </li>
                            <li class="list-group-item @if (request()->user()->documentVerifiedAt) text-success @else text-danger @endif">
                                <i class="fas fa-file mr-2"></i> Documents Verified
                                @if (!request()->user()->documentVerifiedAt)
                                    <div class="float-right">
                                        <a href="{{ route('agentDocuments') }}">
                                            {{ Form::button("<i class='fas fa-tasks'></i> Check", ['class' => 'btn btn-warning btn-sm btn-flat', 'type' => 'reset']) }}
                                        </a>
                                    </div>
                                @endif
                            </li>
                        </ul>
                        <div class="card-footer text-center">
                            <small>Complete to Get Full Access</small>
                        </div>
                    </div>
                @endif


            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Agent Balance Overview</h3>
                            <div class="card-tools">

                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-success text-xl"><i class="fas fa-money-bill    "></i>

                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="fa fa-money text-success"></i> RS. {{ @$balance }}
                                    </span>
                                    <span class="text-muted">Total Balance</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->


                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Agent Package Overview</h3>
                            <div class="card-tools">

                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="fas fa-box    "></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-up text-warning"></i> {{ @$package }}
                                    </span>
                                    <span class="text-muted">Package</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                        </div>
                    </div>
                </div>
            </div>
            <x-chart-component />
        </div>
    </div>
@endsection
