<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 pt-5">
                @include('admin.section.notifications')
                {{ Form::open(['url' => route('registeruser'), 'class' => 'form register_form', 'name' => 'register_form', 'autocomplete' => 'off']) }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p>Air Logistics Register Form</p>
                        </div>
                        <h5><small>Company Detail </small></h5>
                        <hr>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('company_name') ? 'has-error' : '' }}">
                            {{ Form::label('company_name', 'Company name:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('company_name', old('company_name'), ['class' => 'form-control form-control-sm', 'id' => 'company_name', 'placeholder' => 'Company name', 'required' => true]) }}
                                @error('company_name')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
                            {{ Form::label('address', 'Company Address:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('address', old('address'), ['class' => 'form-control form-control-sm', 'id' => 'address', 'placeholder' => 'Enter Company Address', 'required' => true]) }}
                                @error('address')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                            {{ Form::label('email', 'Login Email:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::email('email', old('email'), ['class' => 'form-control form-control-sm', 'id' => 'email', 'placeholder' => 'Login Email', 'required' => true]) }}
                                @error('email')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                            {{ Form::label('password', 'Password:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'required' => isset($user_detail) ? false : true]) }}
                                @error('password')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {{ Form::label('password_confirmation', 'Re-Password:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Re-Password', 'required' => isset($user_detail) ? false : true]) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('country') ? 'has-error' : '' }}">
                            {{ Form::label('country', 'Country:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::select('country', $countries, old('country'), ['class' => 'form-control form-control-sm', 'id' => 'country', 'placeholder' => 'Country', 'required' => true]) }}
                                @error('country')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('state') ? 'has-error' : '' }}">
                            {{ Form::label('state', 'State:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('state', old('state'), ['class' => 'form-control form-control-sm', 'id' => 'state', 'placeholder' => 'State', 'required' => true]) }}
                                @error('state')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('city') ? 'has-error' : '' }}">
                            {{ Form::label('city', 'City:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('city', old('city'), ['class' => 'form-control form-control-sm', 'id' => 'city', 'placeholder' => 'City', 'required' => true]) }}
                                @error('city')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('postal_code') ? 'has-error' : '' }}">
                            {{ Form::label('postal_code', 'Postal Code:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('postal_code', old('postal_code'), ['class' => 'form-control form-control-sm', 'id' => 'postal_code', 'placeholder' => 'Postal Code', 'required' => true]) }}
                                @error('postal_code')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h5><small>Contact Person's Detail</small> </h5>
                        <hr>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('fullname') ? 'has-error' : '' }}">
                            {{ Form::label('fullname', 'Full name:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('fullname', old('fullname'), ['class' => 'form-control form-control-sm', 'id' => 'fullname', 'placeholder' => 'Full name', 'required' => true]) }}
                                @error('fullname')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('mobile') ? 'has-error' : '' }}">
                            {{ Form::label('mobile', 'Mobile Number:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('mobile', old('mobile'), ['class' => 'form-control form-control-sm', 'id' => 'mobile', 'placeholder' => 'Mobile Number', 'required' => true]) }}
                                @error('mobile')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row {{ $errors->has('designation') ? 'has-error' : '' }}">
                            {{ Form::label('designation', 'Designation:*', ['class' => 'col-sm-12']) }}
                            <div class="col-sm-12">
                                {{ Form::text('designation', old('designation'), ['class' => 'form-control form-control-sm', 'id' => 'designation', 'placeholder' => 'Designation', 'required' => true]) }}
                                @error('designation')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        {!! Form::checkbox('agree_terms_and_conditions', true, false, ['']) !!}
                        {!! Form::label('agree_terms_and_conditions', 'I agree to Air logistics terms and conditions.', []) !!}
                    </div>
                    <div class="col-lg-12 text-right">
                        <div class="form-group row">

                            <div class="col-sm-12">
                                {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                                {{-- {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'btn btn-danger btn-flat', 'type' => 'reset']) }} --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
