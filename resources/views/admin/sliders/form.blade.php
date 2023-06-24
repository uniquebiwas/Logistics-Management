@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/slider.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#mainImage').filemanager('image');
    </script>
@endpush
@section('content')
    @include('admin.shared.image_upload')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('slider.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($slider_info))
                        {{ Form::open(['url' => route('slider.update', $slider_info->id), 'files' => true, 'class' => 'form', 'name' => 'slider_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('slider.store'), 'files' => true, 'class' => 'form', 'name' => 'slider_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div
                                class="form-group row {{ $errors->has('en_title') || $errors->has('np_title') ? 'has-error' : '' }}">
                                {{ Form::label('en_title', 'Title (EN):*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('en_title', @$slider_info->title['en'], ['class' => 'form-control', 'id' => 'en_title', 'placeholder' => 'Title', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('en_title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('np_title', 'Title (NP):*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('np_title', @$slider_info->title['np'], ['class' => 'form-control', 'id' => 'np_title', 'placeholder' => 'Title', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('np_title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-2']) }}
                                <div class="col">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$slider_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publish_status')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row {{ $errors->has('en_description') ? 'has-error' : '' }}">
                                {{ Form::label('en_description', 'Description (EN):*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('en_description', @$slider_info->description['en'], ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('en_description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('np_description') ? 'has-error' : '' }}">
                                {{ Form::label('np_description', 'Description (NP):*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('np_description', @$slider_info->description['np'], ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('np_description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
                                {{ Form::label('image', 'Image:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="mainImage" data-input="image" data-preview="holder"
                                                class="global-btn" style="height:38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                                Choose
                                            </a>
                                        </span>
                                        <input id="image" height="100px" class="form-control" type="text" name="image">
                                    </div>
                                    <div id="holder" style="border: 1px solid #ddd;
                                                          border-radius: 4px;
                                                          padding: 5px;
                                                          width: 150px;
                                                          margin-top:15px;"></div>
                                    @if (isset($slider_info->image))
                                        Old Image: &nbsp; <img src="{{ $slider_info->image }}" alt="Couldn't load image"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('image')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-2']) }}
                        <div class="col-sm-10">
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
