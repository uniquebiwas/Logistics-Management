@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="/vendor/laravel-file-manager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function() {
            $('#gallery_button').filemanager('image');
            $('#main_image').filemanager('image');

            $('#gallery').change(function() {
                // alert('hello');
                var input = this;
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#gallery_view').attr('src', e.target.result).fadeIn(1000);
                        $('#gallery_view').removeClass('d-none');
                        // $('#img_edit').addClass('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })
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
                        <a href="{{ route('gallery.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($gallery_info))
                        {{ Form::open(['url' => route('gallery.update', $gallery_info->id), 'files' => true, 'class' => 'form', 'name' => 'gallery_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('gallery.store'), 'files' => true, 'class' => 'form', 'name' => 'information_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        {{-- <input type="hidden" name="roles" value="1" placeholder="dummy"> --}}
                        <div class="col-sm-12">

                            <div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
                                {{ Form::label('title', 'Gallery Name :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('title', @$gallery_info->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Information Name', 'required' => true, 'style' => 'width:100%']) }}
                                    @error('title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
                                {{ Form::label('description', 'Gallery Description :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('description', @$gallery_info->description, ['class' => 'form-control ckeditor', 'id' => 'my-editor', 'placeholder' => 'Information Description', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('featured_img', 'Featured Image:*', ['class' => 'col-sm-2']) }}

                                <div class="input-group col-sm-10">
                                    <span class="input-group-btn">
                                        <a id="main_image" data-input="thumbnail" data-preview="holder"
                                            class="global-btn" style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="featured_img" value="">
                                </div>
                                <div id="holder" style="margin-top:15px;max-width: 60%;">
                                    <img src="{{ create_image_url(@$gallery_info->featured_img) }}" alt=""
                                        style="max-width: 100%">
                                </div>

                            </div>
                            <div class="form-group row">
                                {{ Form::label('gallery', 'Gallery:', ['class' => 'col-sm-2']) }}
                                <div class="input-group col-sm-10">
                                    <span class="input-group-btn">
                                        <a id="gallery_button" data-input="gallery" data-preview="gallery_holder"
                                            class="global-btn" style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="gallery" class="form-control" type="text" name="gallery" value="">
                                </div>
                                <div id="gallery_holder" style="margin-top:15px;max-width: 60%;">
                                    <img src="" alt="" style="max-width: 60%">
                                </div>
                            </div>
                            @if (isset($gallery_info) && $gallery_info->galleryImage->count())
                                <div class="row">
                                    @foreach ($gallery_info->galleryImage as $gallery)
                                        <div class="col-md-4">
                                            <img src="{{ create_image_url(@$gallery->image) }}" alt=""
                                                class="img-thumbnail">
                                            <a href="{{ route('removegalleryimage', $gallery->id) }}" class="btn btn-danger"
                                                onclick="return confirm('Do You Really Wanna Delete?')"><i
                                                    class="fa fa-trash"></i> </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif




                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$gallery_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
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
