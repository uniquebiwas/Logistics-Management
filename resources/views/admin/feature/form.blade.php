@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/feature.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm1').filemanager('image');
        $('#lfm2').filemanager('image');
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
                        <a href="{{ route('feature.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($feature_info))
                        {{ Form::open(['url' => route('feature.update', $feature_info->id), 'files' => true, 'class' => 'form', 'name' => 'feature_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('feature.store'), 'files' => true, 'class' => 'form', 'name' => 'feature_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="col-sm-12">
                            <div
                                class="form-group row {{ $errors->has('title') || $errors->has('short_title') ? 'has-error' : '' }}">
                                {{ Form::label('title', 'Title :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('title', @$feature_info->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Title', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- {{ Form::label('short_title', 'Short Title :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('short_title', @$feature_info->short_title, ['class' => 'form-control', 'maxlength' => '25', 'id' => 'short_title', 'placeholder' => 'Short Title', 'style' => 'width:80%']) }}
                                    @error('short_title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div> --}}
                            </div>

                            {{-- <div class="form-group row {{ $errors->has('short_description') ? 'has-error' : '' }}">
                                {{ Form::label('short_description', 'Short Description :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('short_description', @$feature_info->short_description, ['class' => 'form-control ckeditor', 'maxlength' => '100', 'id' => 'my-editor', 'placeholder' => 'Short Description', 'style' => 'width:80%']) }}
                                    @error('short_description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row {{ $errors->has('full_description') ? 'has-error' : '' }}">
                                {{ Form::label('full_description', 'Long Description :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('full_description', @$feature_info->full_description, ['class' => 'form-control ckeditor', 'id' => 'my-editor1', 'placeholder' => 'Long Description', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('full_description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('icon') ? 'has-error' : '' }}">
                                {{ Form::label('icon', 'Parallex Image:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="icon" data-preview="holder_icon"
                                                class="global-btn" style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                                Choose
                                            </a>
                                        </span>

                                        <input id="icon" height="100px" class="form-control" type="text" name="icon">
                                    </div>
                                    <div id="holder_icon" style="border: 1px solid #ddd;
                                                          border-radius: 4px;
                                                          padding: 5px;
                                                          width: 150px;
                                                          margin-top:15px;"></div>
                                    @if (isset($feature_info->icon))
                                        Old Image: &nbsp; <img src="{{ $feature_info->icon }}" alt="Couldn't load image"
                                            class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('icon')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('feature_image') ? 'has-error' : '' }}">
                                {{ Form::label('feature_image', 'Feature Image:*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm1" data-input="feature_image" data-preview="holder_feature_image"
                                                class="global-btn" style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                                Choose
                                            </a>
                                        </span>
                                        <input id="feature_image" height="100px" class="form-control" type="text"
                                            name="feature_image">
                                    </div>
                                    <div id="holder_feature_image" style="border: 1px solid #ddd;
                                                          border-radius: 4px;
                                                          padding: 5px;
                                                          width: 150px;
                                                          margin-top:15px;"></div>
                                    @if (isset($feature_info->feature_image))
                                        Old Image: &nbsp; <img src="{{ $feature_info->feature_image }}"
                                            alt="Couldn't load image" class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('feature_image')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row {{ $errors->has('parallax_image') ? 'has-error' : '' }}">
                                {{ Form::label('parallax_image', 'Parallax Image:*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm2" data-input="parallax_image" data-preview="holder_parallax_image"
                                                class="btn btn-primary">
                                                 Choose
                                            </a>
                                        </span>
                                        <input id="parallax_image" height="100px" class="form-control" type="text"
                                            name="parallax_image">
                                    </div>
                                    <div id="holder_parallax_image" style="border: 1px solid #ddd;
                                                      border-radius: 4px;
                                                      padding: 5px;
                                                      width: 150px;
                                                      margin-top:15px;"></div>
                                    @if (isset($feature_info->parallax_image))
                                    Old Image: &nbsp; <img src="{{ $feature_info->parallax_image }}" alt="Couldn't load image"
                                    class="img img-thumbail mt-2" style="width: 100px">
                                    @endif
                                    @error('parallax_image')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div
                                class="form-group row {{ $errors->has('position') || $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{-- {{ Form::label('position', 'Position :*', ['class' => 'col-sm-2']) }}
                            <div class="col-sm-4">
                                {{ Form::number('position', @$feature_info->position, ['class' => 'form-control', 'id' => 'position', 'placeholder' => 'Position', 'required' => true, 'style' => 'width:80%']) }}
                                @error('description')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div> --}}
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$feature_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publish_status')
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
