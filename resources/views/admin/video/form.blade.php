@extends('layouts.admin')
@section('title', $title )
@push('scripts')
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
                    <a href="{{ route('video.index') }}" type="button" class="btn btn-tool">
                        <i class="fa fa-list"></i></a>
                </div>
            </div>
            @include('admin.shared.error-messages')
            <div class="card-body">
                @if (isset($video_info))
                    {{ Form::open(['url' => route('video.update', $video_info->id), 'class' => 'form', 'name' => 'video_form']) }}
                    @method('put')
                @else
                    {{ Form::open(['url' => route('video.store'), 'class' => 'form', 'name' => 'video_form']) }}
                @endif
                <div class="row">
                    <div class="col-sm-10 offset-lg-1">
                        {{-- {{ dd($video_info->title['en']) }} --}}
                        @if ($_website == 'English' || $_website == 'Both')
                        <div class="form-group row {{ $errors->has('en_title') ? 'has-error' : '' }}">
                            {{ Form::label('en_title', 'English Full Name (EN):*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('en_title', @$video_info->title['en'], ['class' => 'form-control', 'id' => 'en_title', 'placeholder' => 'English title', 'required' => true, 'style' => 'width:80%']) }}
                                @error('en_title')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        @if ($_website == 'Nepali' || $_website == 'Both')
                        <div class="form-group row {{ $errors->has('np_title') ? 'has-error' : '' }}">
                            {{ Form::label('np_title', 'Nepali title (NP):*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::text('np_title', @$video_info->title['np'], ['class' => 'form-control', 'id' => 'np_title', 'placeholder' => 'Nepali title', 'required' => true, 'style' => 'width:80%']) }}
                                @error('np_title')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif
                      
                        <div class="form-group row {{ $errors->has('url') ? 'has-error' : '' }}">
                            {{ Form::label('url', 'url video :*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::url('url', @$video_info->url, ['class' => 'form-control', 'id' => 'url', 'placeholder' => 'url', 'style' => 'width:80%']) }}
                                @error('url')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('featured') ? 'has-error' : '' }}">
                            {{ Form::label('featured', 'featured :*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('featured', [0 => 'No',1 => 'Yes'],@$video_info->featured, ['id' => 'featured', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                @error('featured')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                            {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$video_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                @error('publish_status')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if ($_website == 'English' || $_website == 'Both')
                        <div class="form-group row {{ $errors->has('en_description') ? 'has-error' : '' }}">
                            {{ Form::label('en_description', 'Description(EN) :*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('en_description', @$video_info->description['en'], ['class' => 'form-control ckeditor', 'id' => 'my-editor1', 'placeholder' => 'Feature Long Description', 'required' => true, 'style' => 'width:80%']) }}
                                @error('en_description')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        @if ($_website == 'Nepali' || $_website == 'Both')
                        <div class="form-group row {{ $errors->has('np_description') ? 'has-error' : '' }}">
                            {{ Form::label('np_description', 'Description(NP) :*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::textarea('np_description', @$video_info->description['np'], ['class' => 'form-control ckeditor', 'id' => 'my-editor2', 'placeholder' => 'Feature Long Description', 'required' => true, 'style' => 'width:80%']) }}
                                @error('np_description')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                    {{-- <input type="hidden" name="roles" value="1" placeholder="dummy"> --}}
                   
                </div>
                <div class="form-group row">
                            {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                                {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'btn btn-danger btn-flat', 'type' => 'reset']) }}
                            </div>
                        </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@endsection