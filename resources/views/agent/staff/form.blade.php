@extends('layouts.admin')
@section('title', 'Add New Users')
@push('scripts')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/user.js') }}"></script>
    <script>
        $('#change_password').change(function(e) {
            e.preventDefault();
            let is_checked = $(this).prop('checked');
            if (is_checked) {
                $('#password').attr('required', 'required');
                $('#password_confirmation').attr('required', 'required');
                $('.password_change').removeClass('d-none');
            } else {
                $('#password').removeAttr('required', 'required');
                $('#password_confirmation').removeAttr('required', 'required');
                $('.password_change').addClass('d-none');
            }
        });
        $(document).ready(function() {
            $('#roles').select2({
                placeholder: "User Role",
            });
        });
    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New User</h3>
                    <div class="card-tools">
                        <a href="{{ route('agent-staff.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($user_detail->id)
                        {{ Form::open(['url' => route('agent-staff.update', $user_detail->id), 'files' => true, 'class' => 'form', 'name' => 'user_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('agent-staff.store'), 'files' => true, 'class' => 'form', 'name' => 'user_form']) }}
                    @endif

                    <div class="form-group row {{ $errors->has('en_name') ? 'has-error' : '' }}">
                        {{ Form::label('en_name', 'User Full Name(EN):*', ['class' => 'col-sm-2']) }}
                        <div class="col-sm-10">
                            {{ Form::text('en_name', @$user_detail->name['en'], ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'User Full Name', 'required' => true, 'style' => 'width:80%']) }}
                            @error('en_name')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="form-group row {{ $errors->has('mobile') ? 'has-error' : '' }}">
                        {{ Form::label('mobile', 'User Mobile:*', ['class' => 'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('mobile', @$user_detail->mobile, ['class' => 'form-control', 'id' => 'mobile', 'placeholder' => 'User Mobile', 'required' => true, 'style' => 'width:80%']) }}
                            @error('mobile')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                        {{ Form::label('email', 'User Email:*', ['class' => 'col-sm-2']) }}
                        <div class="col-sm-10">
                            {{ Form::email('email', @$user_detail->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'User Email', 'required' => true, 'style' => 'width:80%', 'disabled' => $user_detail->id ? true : false]) }}
                            @error('email')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row {{ $user_detail->id ? '' : 'd-none' }}">
                        {{ Form::label('chanage_password', 'Change Password:', ['class' => 'col-sm-2']) }}
                        <div class="col-sm-10">
                            {{ Form::checkbox('change_password', 1, false, ['id' => 'change_password']) }} Yes
                        </div>
                    </div>
                    <div class="password_change {{ $user_detail->id ? 'd-none' : '' }}">
                        <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                            {{ Form::label('password', 'Password:*', ['class' => 'col-sm-2']) }}
                            <div class="col-sm-10">
                                {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'required' => isset($user_detail) ? false : true, 'style' => 'width:80%']) }}
                                @error('password')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {{ Form::label('password_confirmation', 'Re-Password:*', ['class' => 'col-sm-2']) }}
                            <div class="col-sm-10">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Re-Password', 'required' => isset($user_detail) ? false : true, 'style' => 'width:80%']) }}
                            </div>
                        </div>
                    </div>


                    <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                        {{ Form::label('publish_status', 'User Status:*', ['class' => 'col-sm-2']) }}
                        <div class="col-sm-10">
                            {{ Form::select('publish_status', [1 => 'Active', 0 => 'Inactive'], @$user_detail->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                            @error('publish_status')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-2']) }}
                        <div class="col-sm-10">
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'global-btn mr-2', 'type' => 'submit']) }}
                            {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'global-btn', 'type' => 'reset']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
