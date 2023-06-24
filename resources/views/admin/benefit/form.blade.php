@extends('layouts.admin')
@section('title', $title)
@push('styles')
    <style>
        label {
            text-transform: capitalize;
        }

    </style>
@endpush
@push('scripts')
    @include('admin.section.ckeditor')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="/vendor/laravel-file-manager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function() {
            $('#gallery_button').filemanager('image');
            $('#main_image').filemanager('image');
        })
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
                        <a href="{{ route('information.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if ($benifit->id)
                        {!! Form::open(['url' => route('benefit.update', $benifit->id)]) !!}
                        @method('PATCH')
                    @else
                        {!! Form::open(['url' => route('benefit.store')]) !!}
                    @endif
                    @csrf

                    <div class="form-group row">
                        {!! Form::label('title', 'Title', ['class' => 'col-2']) !!}
                        {!! Form::text('title', $benifit->title, ['class' => 'form-control col-10 form-control-sm', 'placeholder' => 'title']) !!}
                        @error('title')
                            <small id="helpId" class="text-danger col-12">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group row">
                        {!! Form::label('description', 'description', ['class' => 'col-2']) !!}
                        {!! Form::textarea('description', $benifit->description, ['class' => 'form-control col-10 form-control-sm ckeditor', 'placeholder' => 'description']) !!}
                        @error('description')
                            <small id="helpId" class="text-danger col-12">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group row {{ $errors->has('publishStatus') ? 'has-error' : '' }}">
                        {{ Form::label('publishStatus', 'Publish Status :*', ['class' => 'col-2']) }}
                        {{ Form::select('publishStatus', [1 => 'Yes', 0 => 'No'], $benifit->publishStatus, ['id' => 'publishStatus', 'required' => true, 'class' => 'form-control col-10', 'style' => 'width:100%']) }}
                        @error('publishStatus')
                            <span class="help-block error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        {{ Form::label('image', 'Featured Image:*', ['class' => 'col-sm-2']) }}

                        <div class="input-group col-10 pl-0">
                            <span class="input-group-btn">
                                <a id="main_image" data-input="thumbnail" data-preview="holder" class="global-btn"
                                    style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="image" value="">
                        </div>
                        <div id="holder" style="margin-top:15px;max-width: 60%;">
                            <img src="{{ $benifit->image }}" alt="" style="max-width: 100%">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-10 pl-0">
                            {!! Form::submit('submit', ['class' => 'global-btn mr-2']) !!}
                            <button type="reset" class="global-btn">Reset</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
