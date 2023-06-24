@extends('layouts.admin')
@section('title', @$title)
@push('scripts')
    @include('admin.section.ckeditor')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm1').filemanager('image');
    </script>
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/agent.js') }}"></script>
    <script>
        $('#change_password').change(function(e) {
            e.preventDefault();
            let is_checked = $(this).prop('checked');
            if (is_checked) {
                $('#password').attr('required', 'required');
                $('#password_confirmation').attr('required', 'required');
                $('#password_change').removeClass('d-none');
            } else {
                $('#password').removeAttr('required', 'required');
                $('#password_confirmation').removeAttr('required', 'required');
                $('#password_change').addClass('d-none');
            }
        });
        $('#mobile').change(function(e) {
            e.preventDefault();
            let mobileNumber = $(this).val();
            $.ajax({
                url: '{{ route('numberexists') }}',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    number: mobileNumber,
                },
                success: function(response) {
                    if (response != 0) {
                        alert('Number you have entered already exists!')
                    }
                }
            });
        });
    </script>
@endpush
@section('content')
    {{-- {{ dd($agent_info->agent_profile) }} --}}
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('agents.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($agent_info->id))
                        {{ Form::open(['url' => route('agents.update', $agent_info->id), 'files' => true, 'class' => 'form', 'name' => 'agent_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('agents.store'), 'files' => true, 'class' => 'form', 'name' => 'agent_form']) }}
                    @endif

                    <div class="text-center page-titles">
                        <strong> Owner Detail Information</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row {{ $errors->has('en_name') ? 'has-error' : '' }}">
                                {{ Form::label('en_name', 'Full Name:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('en_name', @$agent_info->name['en'], ['class' => 'form-control', 'id' => 'en_name', 'placeholder' => 'Full Name', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('en_name')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                {{ Form::label('mobile', 'Mobile:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('mobile', @$agent_info->mobile, ['class' => 'form-control', 'id' => 'mobile', 'placeholder' => 'Agent Mobile', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('mobile')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('email', 'Email:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::email('email', @$agent_info->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Agent Email', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if ($agent_info->id)
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    {{ Form::label('change_password', 'Change Password:', ['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::checkbox('change_password', 1, false, ['id' => 'change_password']) }}
                                        Yes
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row col-lg-12" id="password_change">
                            <div class="col-lg-6">
                                <x-password :required='$agent_info->id ? false : true'/>

                            </div>
                            <div class="col-lg-6">
                                <x-password name="password_confirmation" label="Re-password:*" :required="$agent_info->id ? false : true" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row {{ $errors->has('designation') ? 'has-error' : '' }}">
                                {{ Form::label('designation', 'Designation:', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('designation', @$agent_info->agent_profile->designation, ['class' => 'form-control', 'id' => 'designation', 'placeholder' => 'Agent designation', 'style' => 'width:80%']) }}
                                    @error('designation')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            @if ($agent_info)
                                <div class="form-group row {{ $errors->has('accountNumber') ? 'has-error' : '' }}">
                                    {{ Form::label('accountNumber', 'Agent Account Number:*', ['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('accountNumber', @$agent_info->accountNumber, ['class' => 'form-control', 'id' => 'accountNumber', 'placeholder' => 'Agent Account Number', 'readonly' => 'readonly', 'style' => 'width:80%']) }}
                                        @error('accountNumber')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if (!isset($agent_info))


                        <div class="text-center page-titles">
                            <strong>Manual Verifications</strong>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 row">
                                {{ Form::label('emailVerified', 'Email Verified ? :', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-2">
                                    {{ Form::checkbox('emailVerified', null, false, ['id' => 'emailVerified', 'style' => 'width:80%']) }}
                                    @error('emailVerified')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('phoneVerified', 'Mobile Verified ? :', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-2">
                                    {{ Form::checkbox('phoneVerified', null, false, ['id' => 'phoneVerified', 'checked' => false, 'style' => 'width:80%']) }}
                                    @error('phoneVerified')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('documentVerified', 'Documents Verified ? :', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-2">
                                    {{ Form::checkbox('documentVerified', null, false, ['id' => 'documentVerified', 'checked' => false, 'style' => 'width:80%']) }}
                                    @error('documentVerified')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="text-center page-titles">
                        <strong> Company Detail</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div
                                class="form-group row {{ $errors->has('company_name') || $errors->has('address') ? 'has-error' : '' }}">
                                {{ Form::label('company_name', 'Name:*', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::text('company_name', @$agent_info->agent_profile->company_name, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Company Name', 'required' => true, 'style' => 'width:90%']) }}
                                    @error('company_name')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('address', 'Address:*', ['class' => 'col-sm-4']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('address', @$agent_info->agent_profile->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Company Address',  'style' => 'width:90%']) }}
                                    @error('address')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div
                                class="form-group row {{ $errors->has('city') || $errors->has('companyPhone') ? 'has-error' : '' }}">
                                {{ Form::label('city', 'City:*', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::text('city', @$agent_info->agent_profile->city, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'City', 'style' => 'width:90%']) }}
                                    @error('city')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('companyPhone', 'Phone:*', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::number('companyPhone', @$agent_info->agent_profile->phone, ['class' => 'form-control', 'id' => 'companyPhone', 'placeholder' => 'Company Phone Number', 'style' => 'width:90%']) }}
                                    @error('companyPhone')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div
                                class="form-group row {{ $errors->has('state') || $errors->has('country') ? 'has-error' : '' }}">
                                {{ Form::label('state', 'State:*', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::text('state', @$agent_info->agent_profile->state, ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'State', 'style' => 'width:90%']) }}
                                    @error('state')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="gorm-group row">
                                {{ Form::label('country', 'Country:*', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::select('country', $countries, @$agent_info->agent_profile->country, ['class' => 'form-control', 'id' => 'country', 'placeholder' => 'Country', 'required' => true, 'style' => 'width:90%']) }}
                                    @error('country')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('website', 'Website URL:', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::text('website', @$agent_info->agent_profile->website, ['class' => 'form-control', 'id' => 'website', 'placeholder' => 'Website URL', 'style' => 'width:90%']) }}
                                    @error('website')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row {{ $errors->has('company_phone') ? 'has-error' : '' }}">
                                {{ Form::label('company_phone', 'Tel/Mobile:*', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::number('company_phone', @$agent_info->agent_profile->company_phone, ['class' => 'form-control', 'id' => 'company_phone', 'placeholder' => 'Accountant Contact Number',  'style' => 'width:90%']) }}
                                    @error('company_phone')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row {{ $errors->has('vatNumber') ? 'has-error' : '' }}">
                                {{ Form::label('vatNumber', 'Pan / Vat:*', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::number('vatNumber', @$agent_info->agent_profile->vatNumber, ['class' => 'form-control', 'id' => 'vatNumber', 'placeholder' => 'Company Pan/ Vat',  'style' => 'width:90%']) }}
                                    @error('vatNumber')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="text-center page-titles">
                        <strong>Account Department Details</strong>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div
                                class="form-group row {{ $errors->has('') || $errors->has('accountant_name') ? 'has-error' : '' }}">
                                {{ Form::label('accountant_name', 'Name:', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::text('accountant_name', @$agent_info->agent_profile->accountant_name, ['class' => 'form-control', 'id' => 'accountant_name', 'placeholder' => 'Accountant Name', 'style' => 'width:90%']) }}
                                    @error('accountant_name')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div
                                class="form-group row {{ $errors->has('') || $errors->has('accountant_name') ? 'has-error' : '' }}">
                                {{ Form::label('accountant_email', 'Email:', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::email('accountant_email', @$agent_info->agent_profile->accountant_email, ['class' => 'form-control', 'id' => 'accountant_email', 'placeholder' => 'Accountant Email', 'style' => 'width:90%']) }}
                                    @error('accountant_email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div
                                class="form-group row {{ $errors->has('accountant_phone') || $errors->has('accountant_phone') ? 'has-error' : '' }}">
                                {{ Form::label('accountant_phone', 'Mobile:', ['class' => 'col-sm-4']) }}
                                <div class="col-sm-8">
                                    {{ Form::number('accountant_phone', @$agent_info->agent_profile->accountant_phone, ['class' => 'form-control', 'id' => 'accountant_phone', 'placeholder' => 'Accountant Contact Number', 'style' => 'width:90%']) }}
                                    @error('accountant_phone')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'global-btn', 'type' => 'submit']) }}
                            {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'global-btn', 'type' => 'reset']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.passwordChange').on('click', function(event) {
                $(this).find('i').toggleClass("fa-eye fa-eye-slash");
                $(this).siblings('input').attr('type', function(i, val) {
                    return $(this).attr('type') == 'password' ? 'text' : 'password';
                });
            })
        })
    </script>
@endpush
