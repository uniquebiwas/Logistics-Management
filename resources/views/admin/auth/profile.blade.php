@extends('layouts.admin')
@section('title','Update Profile')
@section('content')
<section class="content-header mt-0 pt-0"></section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="img-fluid img-circle" src="{{ auth()->user()->profileImage ?? asset('/images/placeholder.png') }}" style="width:80px" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"> {{ auth()->user()->agent_profile->company_name }}</h3>

            <p class="text-muted text-center">{{ auth()->user()->name['en'] }} ({{request()->user()->roles->first()->name}})</p>

          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-bold">Manage User Credential & Security</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
              <div class="row">

                </div>
                <div class="col-md-12">
                  <h5 class="">Update Password</h5>
                  <p class="text-sm">Ensure your account is using a long random password to stay secure.</p>
                  <p class="text-sm">Password should be atleast 8 letter long.</p>

                  <hr>
                  <div class="m-0">
                    {{Form::open(['url'=>route('update-password',auth()->user()->id),'files'=>true,'class'=>'form'])}}
                    @method('put')
                    <div class="form-group row @error('name') has-error @enderror">
                        <div class="col-sm-11">
                            {{Form::label('name','User Name:*',['class'=>''])}}
                            {{Form::text('name',@(auth()->user()->name['en']),['class'=>'form-control form-control','id'=>'name','placeholder'=>'Email','required'=>true,'style'=>'width:80%','readonly'])}}
                            @error('name')
                            <span class="help-block error"><small>{{$message}}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('current_password') has-error @enderror">
                        {{-- <div class="col-sm-1"></div> --}}
                        <div class="col-sm-11">
                            {{Form::label('current_password','Current Password:*',['class'=>''])}}
                            {{Form::password('current_password',['class'=>'form-control form-control','id'=>'current_password','placeholder'=>'Current Password','style'=>'width:80%','required'=>true])}}
                            @error('current_password')
                            <span class="help-block error"><small>{{$message}}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row @error('password') has-error @enderror">
                        {{-- <div class="col-sm-1"></div> --}}
                        <div class="col-sm-11">
                            {{Form::label('password','New Password:*',['class'=>''])}}
                            {{Form::password('password',['class'=>'form-control form-control','id'=>'password','placeholder'=>'New Password','style'=>'width:80%','required'=>true])}}
                            @error('password')
                            <span class="help-block error"><small>{{$message}}</small></span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('password_confirmation') has-error @enderror">
                        {{-- <div class="col-sm-1"></div> --}}
                        <div class="col-sm-11">
                            {{Form::label('password_confirmation','Confirm Password:*',['class'=>''])}}
                            {{Form::password('password_confirmation',['class'=>'form-control form-control','id'=>'password_confirmation','placeholder'=>'Confirm Password','style'=>'width:80%','required'=>true])}}
                            @error('password_confirmation')
                            <span class="help-block error"><small>{{$message}}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {{Form::label('','',['class'=>''])}}
                        <div class="col-sm-5">
                            {{Form::button("<i class='fa fa-paper-plane'></i> Update",['class'=>'global-btn','type'=>'submit'])}}
                        </div>
                    </div>
                    {{Form::close()}}
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
