@extends('layouts.admin')
@section('title', 'Update Profile')
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3">
                    <div class="card card-primary">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid img-circle"
                                    src="{{ create_image_url(@$sitesetting->favicon, 'thumbnail') }}" style="width:80px"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ auth()->user()->name['en'] }}</h3>

                            <p class="text-muted text-center">{{ request()->user()->roles->first()->name }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Post Created</b> <a class="float-right">{{ @$news ?? 0 }}</a>
                                </li>
                               
                            </ul>

                            <a href="{{ route('agentProfile') }}" class="btn btn-primary btn-block">
                                <b>Go to Profile </b>
                                </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Manage User Credential & Security</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                 

                            </div>
                            <div class="col-md-12">
                                <h5 class="text-primary">Update Profile</h5>
                                {{-- <p class="text-sm">Ensure your account is using a long random password to stay secure.</p> --}}
                                <hr>
                                <div class="m-0">
                                    {{ Form::open(['url' => route('updateAgentProfile'), 'files' => true, 'class' => 'form']) }}
                                

                                    <div class="form-group row @error('name') has-error @enderror">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            {{ Form::label('name', 'User Name:*', ['class' => '']) }}
                                            {{ Form::text('name', @$profile->name['en'], ['class' => 'form-control form-control', 'id' => 'name', 'placeholder' => 'Full name', 'required' => true, 'style' => 'width:80%' ]) }}
                                            @error('name')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row @error('address') has-error @enderror">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            {{ Form::label('address', 'Address :*', ['class' => '']) }}
                                            {{ Form::text('address', @$profile->permanentAddress, ['class' => 'form-control form-control', 'id' => 'address', 'placeholder' => 'Address',  'style' => 'width:80%' ]) }}
                                            @error('address')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                      
                                    <div class="form-group row">
                                        {{ Form::label('', '', ['class' => 'col-sm-7']) }}
                                        <div class="col-sm-5">
                                            {{ Form::button(" Update", ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
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
