@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
   <script>
        $('#feature_img_lfm').filemanager('image');
   </script>
       <script>
            $(document).ready(function() {
                $('#featured_img').change(function() {
                    // alert('hello');
                    var input = this;
                    if (input.files && input.files[0]) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#featured_image_view').attr('src', e.target.result).fadeIn(1000);
                            $('#featured_image_view').removeClass('d-none');
                            // $('#img_edit').addClass('d-none');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                })

                $('#parallex_img').change(function() {
                    // alert('hello');
                    var input = this;
                    if (input.files && input.files[0]) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#parallex_image_view').attr('src', e.target.result).fadeIn(1000);
                            $('#parallex_image_view').removeClass('d-none');
                            // $('#img_edit').addClass('d-none');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                })
            })

        </script>
        @include('admin.section.ckeditor')

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
                        <a href="{{ route('serviceCategory.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($serviceCategory_info))
                        {{ Form::open(['url' => route('serviceCategory.update', $serviceCategory_info->id), 'files' => true, 'class' => 'form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('serviceCategory.store'), 'files' => true, 'class' => 'form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        {{-- <input type="hidden" name="roles" value="1" placeholder="dummy"> --}}
                        <div class="col-sm-6 col-md-12 offset-lg-1">
                            @if ($_website == 'Nepali' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('np_title') ? 'has-error' : '' }}">
                                    {{ Form::label('np_title', 'serviceCategory Nepali :*', ['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('np_title', @$serviceCategory_info->title['np'], ['class' => 'form-control', 'id' => 'nepali Title', 'placeholder' => 'serviceCategory Nepali Title', 'required' => true, 'style' => 'width:80%']) }}
                                        @error('np_title')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($_website == 'English' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('en_title') ? 'has-error' : '' }}">
                                    {{ Form::label('en_title', 'serviceCategory English Title:*', ['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::text('en_title', @$serviceCategory_info->title['en'], ['class' => 'form-control', 'id' => 'en_title', 'placeholder' => 'serviceCategory english Title', 'required' => true, 'style' => 'width:80%']) }}
                                        @error('en_title')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($_website == 'English' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
                                    {{ Form::label('description', 'serviceCategory Description :*', ['class' => 'col-sm-3']) }}
                                    <div class="col-sm-9">
                                        {{ Form::textarea('description', @$serviceCategory_info->description['en'], ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'serviceCategory Description', 'required' => true, 'style' => 'width:80%']) }}
                                        @error('description')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @if ($_website == 'Nepali' || $_website == 'Both')
                            <div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
                                {{ Form::label('description', 'serviceCategory Description :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::textarea('description', @$serviceCategory_info->description['np'], ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'serviceCategory Description', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif


                        </div>
                        <div class="col-sm-4 offset-lg-1">
                            <div class="form-group row {{ $errors->has('position') ? 'has-error' : '' }}">
                                {{ Form::label('position', 'serviceCategory Position :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('position', @$serviceCategory_info->orderPosition, ['class' => 'form-control', 'id' => 'position', 'placeholder' => 'serviceCategory External Url', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$serviceCategory_info->publishStatus, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publish_status')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
                                {!! Html::decode(Form::label('image', '<i class="fas fa-images"></i> Featured Image :', ['class' => 'col-sm-8', 'style' => 'padding-left: 0px'])) !!}
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="MainImage" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary">
                                                     Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="filepath"
                                                value="{{ @$serviceCategory_info->image }}">
                                        </div>
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-width: 100%;">
                                        <img src="{{ @$serviceCategory_info->image }}" alt="" style="max-width: 100%">
                                    </div>
                                </div>
                            </div>
                        </div>
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
