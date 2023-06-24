@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        @include('admin.section.ckeditor')
        <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/membership.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#image_url_button').filemanager('image');
                $('#parallex_img_button').filemanager('image');
                $(".select2").select2();
            })

        </script>
        @include('admin.section.ckeditor')

    @endpush
@section('content')

    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('membership.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($membership_info))
                        {{ Form::open(['url' => route('membership.update', $membership_info->id), 'files' => true, 'class' => 'form', 'name' => 'membership_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('membership.store'), 'files' => true, 'class' => 'form', 'name' => 'membership_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="ml-4 col-lg-7 col-md-7 col-sm-12 ">
                            @if ($_website == 'Nepali' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('np_title') ? 'has-error' : '' }}">
                                    {{ Form::label('np_title', 'Title :*', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('np_title', @$membership_info->title['np'], ['class' => 'form-control', 'id' => 'np_title', 'placeholder' => 'Title', 'required' => true, 'style' => 'width:80%']) }}
                                        @error('np_title')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($_website == 'English' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('en_title') ? 'has-error' : '' }}">
                                    {{ Form::label('en_title', 'Title:', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('en_title', @$membership_info->title['en'], ['class' => 'form-control', 'maxlength' => '25', 'id' => 'en_title', 'placeholder' => 'Title', 'style' => 'width:80%']) }}
                                        @error('en_title')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif


                            @if ($_website == 'Nepali' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('np_description') ? 'has-error' : '' }}">
                                    {{ Form::label('np_description', 'Description :*', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('np_description', @$membership_info->description['np'], ['class' => 'form-control ckeditor', 'maxlength' => '100', 'id' => 'np_description', 'placeholder' => '  Description in Nepali', 'style' => 'width:80%']) }}
                                        @error('np_description')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($_website == 'English' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('en_description') ? 'has-error' : '' }}">
                                    {{ Form::label('en_description', ' Description:*', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('en_description', @$membership_info->description['en'], ['class' => 'form-control ckeditor', 'id' => 'en_description', 'placeholder' => 'Description in English', 'required' => true, 'style' => 'width:80%']) }}
                                        @error('en_description')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif


                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12  ">

                            <div class="form-group row">
                                {{ Form::label('image_url', 'Image:*', ['class' => 'col-sm-12']) }}
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="image_url_button" data-input="image_url" data-preview="image_url_holder"
                                            class="btn btn-primary">
                                            Choose
                                        </a>
                                    </span>
                                    <input id="image_url" class="form-control" type="text" name="image_url">
                                </div>
                                <div id="image_url_holder" style="margin-top:15px;max-width: 100%;">
                                    <img src="" alt="" style="max-width: 100%">
                                </div>
                                @if (isset($membership_info->image_url))
                                    Old Image: &nbsp; <img src="{{ $membership_info->image_url }}"
                                        alt="Couldn't load image" class="img img-thumbail mt-2" style="width: 100px">
                                @endif
                            </div>

                            <div class="form-group row {{ $errors->has('package_amount') ? 'has-error' : '' }}">
                                {{ Form::label('package_amount', ' Package Amount :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::number('package_amount', @$membership_info->package_amount, ['class' => 'form-control', 'id' => 'package_amount', 'placeholder' => 'Package Amount', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('package_amount')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('yearly_max_request') ? 'has-error' : '' }}">
                                {{ Form::label('yearly_max_request', ' Yearly Maximum Request :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::number('yearly_max_request', @$membership_info->yearly_max_request, ['class' => 'form-control', 'id' => 'yearly_max_request', 'placeholder' => 'Yearly Maximum Request', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('yearly_max_request')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$membership_info->publishStatus, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publish_status')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                {{ Form::label('', '', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                                    {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'btn btn-danger btn-flat', 'type' => 'reset']) }}
                                </div>
                            </div>

                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
