<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/agent/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/agent/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/agent/style.css') }}">
</head>

<body>

    @include('admin.section.notifications')
    <div class="register-wrap">
        <div class="container">
            <div class="register-col">
                {{ Form::open(['url' => route('registeruser'), 'class' => 'form register_form', 'name' => 'register_form', 'autocomplete' => 'off']) }}
                @csrf
                <div class="reg-list">
                    <div class="reg-title">
                        <h3> Owner Detail Information</h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div
                                class="form-group row {{ $errors->has('en_name') || $errors->has('np_name') ? 'has-error' : '' }}">
                                {{ Form::label('en_name', 'Full Name:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('en_name', old('en_name'), ['class' => 'form-control', 'id' => 'en_name', 'placeholder' => 'Full Name', 'required' => true,]) }}
                                    @error('en_name')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div
                                class="form-group row {{ $errors->has('mobile') || $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('mobile', 'Mobile:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::number('mobile', old('mobile'), ['class' => 'form-control', 'id' => 'mobile', 'placeholder' => 'Mobile', 'required' => true]) }}
                                    @error('mobile')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('email', 'Email:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'required' => true]) }}
                                    @error('email')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('password') || $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                {{ Form::label('password', 'Password:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        >
                                    {{-- {{ Form::password('password', old('password'), ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'required' => true]) }} --}}
                                    @error('password')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('password_confirmation', 'Re-password:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Re-Password">

                                    {{-- {{ Form::password('password_confirmation', old('password_confirmation'), ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'Re-Password', 'required' => true, 'style' => 'width:80%']) }} --}}
                                    @error('password_confirmation')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="reg-list">
                    <div class="reg-title">
                        <h3> Company Detail</h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div
                                class="form-group row {{ $errors->has('company_name') || $errors->has('address') ? 'has-error' : '' }}">
                                {{ Form::label('company_name', 'Name:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('company_name', old('company_name'), ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Company Name', 'required' => true]) }}
                                    @error('company_name')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                            </div>
                            <div
                                class="form-group row {{ $errors->has('city') || $errors->has('companyPhone') ? 'has-error' : '' }}">
                                {{ Form::label('address', 'Address:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Company Address', 'required' => true]) }}
                                    @error('address')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('companyPhone', 'Phone:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::number('companyPhone', old('companyPhone'), ['class' => 'form-control', 'id' => 'companyPhone', 'placeholder' => 'Company Phone Number', 'required' => true]) }}
                                    @error('companyPhone')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('state') || $errors->has('country') ? 'has-error' : '' }}">
                                {{ Form::label('city', 'City:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('city', old('city'), ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'City', 'required' => true]) }}
                                    @error('city')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('state', 'State:', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('state', old('state'), ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'State', 'required' => true]) }}
                                    @error('state')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div
                                class="form-group row {{ $errors->has('website') || $errors->has('facebook') ? 'has-error' : '' }}">
                                {{ Form::label('country', 'Country:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::select('country', $countries, old('country'), ['class' => 'form-control', 'id' => 'country', 'placeholder' => 'Country', 'required' => true]) }}
                                    @error('country')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('website', 'Website URL:', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('website', old('website'), ['class' => 'form-control', 'id' => 'website', 'placeholder' => 'Website URL', 'required' => true]) }}
                                    @error('website')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- {{ Form::label('facebook', 'Facebook URL:', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('facebook', old('facebook'), ['class' => 'form-control', 'id' => 'facebook', 'placeholder' => 'Facebook URL', 'required' => true]) }}
                                    @error('facebook')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}
                            </div>



                        </div>

                    </div>
                </div>
                <div class="reg-list">
                    <div class="reg-title">
                        <h3> Account Department Detail</h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div
                                class="form-group row {{ $errors->has('') || $errors->has('accountant_name') ? 'has-error' : '' }}">
                                {{ Form::label('accountant_name', 'Name:', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('accountant_name', @$agent_info->agent_profile->accountant_name, ['class' => 'form-control', 'id' => 'accountant_name', 'placeholder' => 'Accountant Name', 'required' => true]) }}
                                    @error('accountant_name')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('accountant_email', 'Email:', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::email('accountant_email', @$agent_info->agent_profile->accountant_email, ['class' => 'form-control', 'id' => 'accountant_email', 'placeholder' => 'Accountant Email', 'required' => true]) }}
                                    @error('accountant_email')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('accountant_phone') || $errors->has('accountant_phone') ? 'has-error' : '' }}">
                                {{ Form::label('accountant_phone', 'Mobile:', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::number('accountant_phone', @$agent_info->agent_profile->accountant_phone, ['class' => 'form-control', 'id' => 'accountant_phone', 'placeholder' => 'Accountant Contact Number', 'required' => true]) }}
                                    @error('accountant_phone')
                                        <span class="help-block error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="reg-foot">
                    <div class="form-group form-check" style="padding-left:0;">
                        {!! Form::checkbox('agree_terms_and_conditions', true, false, ['form-check-inputclass' => '']) !!}
                        {!! Form::label('agree_terms_and_conditions', 'I agree to Air logistics terms and conditions.', ['class' => 'form-check-label']) !!}
                    </div>
                    <button type="submit" class="global-btn">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <script src="{{ asset('front/agent/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front/agent/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
