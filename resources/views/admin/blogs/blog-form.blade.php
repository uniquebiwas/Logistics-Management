@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    @include('admin.section.ckeditor')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/blog.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#featured_img_button').filemanager('image');
            $('#parallex_img_button').filemanager('image');
            $(".select2").select2();
        })
    </script>
@endpush
@section('content')

    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('blog.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($blog_info))
                        {{ Form::open(['url' => route('blog.update', $blog_info->id), 'files' => true, 'class' => 'form', 'name' => 'blog_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('blog.store'), 'files' => true, 'class' => 'form', 'name' => 'blog_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        {{-- <input type="hidden" name="roles" value="1" placeholder="dummy"> --}}
                        <div class="ml-4 col-lg-7 col-md-7 col-sm-12 ">
                            @if ($_website == 'Nepali' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('np_title') ? 'has-error' : '' }}">
                                    {{ Form::label('np_title', 'Blog Title (Nepali) :*', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('np_title', @$blog_info->title['np'], ['class' => 'form-control', 'id' => 'np_title', 'placeholder' => 'Blog Title (in Nepali)', 'required' => true, 'style' => 'width:80%']) }}
                                        @error('np_title')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($_website == 'English' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('en_title') ? 'has-error' : '' }}">
                                    {{ Form::label('en_title', 'Blog Title (English) :', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::text('en_title', @$blog_info->title['en'], ['class' => 'form-control', 'id' => 'en_title', 'placeholder' => 'Blog Title (in English)', 'style' => 'width:80%']) }}
                                        @error('en_title')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="form-group row {{ $errors->has('tag') ? 'has-error' : '' }}">
                                {{ Form::label('tag', 'Tags :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::select('tag[]', @$tags, @$selectedtags, ['id' => 'tag', 'required' => false, 'class' => 'form-control select2', 'multiple' => true, 'style' => 'width:80%']) }}
                                    @error('tag')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            @if ($_website == 'English' || $_website == 'Both')

                                <div class="form-group row {{ $errors->has('en_summary') ? 'has-error' : '' }}">
                                    {{ Form::label('en_summary', 'Blog Summary :', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('en_summary', @$blog_info->summary['en'], ['class' => 'form-control   col-lg-6', 'rows' => 3, 'id' => 'en_short_description', 'placeholder' => 'Content Short Description (in English)', 'required' => true, 'style' => 'height:40%']) }}

                                        {{-- {{ Form::text('summary', @$blog_info->summary, ['class' => 'form-control','id' => 'summary', 'placeholder' => 'Blog Summary', 'style' => 'width:80%']) }} --}}
                                        @error('en_summary')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($_website == 'Nepali' || $_website == 'Both')

                                <div class="form-group row {{ $errors->has('np_summary') ? 'has-error' : '' }}">
                                    {{ Form::label('np_summary', 'Blog Summary :', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('np_summary', @$blog_info->summary['np'], ['class' => 'form-control   col-lg-6', 'rows' => 3, 'id' => 'en_short_description', 'placeholder' => 'Content Short Description (in English)', 'required' => true, 'style' => 'height:40%']) }}

                                        {{-- {{ Form::text('summary', @$blog_info->summary, ['class' => 'form-control','id' => 'summary', 'placeholder' => 'Blog Summary', 'style' => 'width:80%']) }} --}}
                                        @error('np_summary')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row {{ $errors->has('postType') ? 'has-error' : '' }}">
                                {{ Form::label('postType', 'Blog Type :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::select('postType', ['news' => 'News', 'article' => 'Article'], @$blog_info->postType, ['id' => 'type', 'required' => false, 'class' => 'form-control select2', 'style' => 'width:80%']) }}
                                    @error('postType')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @if ($_website == 'Nepali' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('np_description') ? 'has-error' : '' }}">
                                    {{ Form::label('np_description', 'Blog Description (Nepali) :*', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('np_description', @$blog_info->description['np'], ['class' => 'form-control ckeditor', 'id' => 'np_description', 'placeholder' => ' Blog  Description in Nepali', 'style' => 'width:80%']) }}
                                        @error('np_description')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($_website == 'English' || $_website == 'Both')
                                <div class="form-group row {{ $errors->has('en_description') ? 'has-error' : '' }}">
                                    {{ Form::label('en_description', ' Blog Description (English) :*', ['class' => 'col-sm-12']) }}
                                    <div class="col-sm-12">
                                        {{ Form::textarea('en_description', @$blog_info->description['en'], ['class' => 'form-control ckeditor', 'id' => 'en_description', 'placeholder' => 'Blog Description in English', 'required' => true, 'style' => 'width:80%']) }}
                                        @error('en_description')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif


                            <div class="form-group row {{ $errors->has('external_url') ? 'has-error' : '' }}">
                                {{ Form::label('external_url', 'External Url :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::text('external_url', @$blog_info->external_url, ['class' => 'form-control', 'id' => 'external_url', 'placeholder' => 'Blog External Url', 'style' => 'width:80%']) }}
                                    @error('description')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3><strong>SEO Tools</strong></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group row {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_title', 'Meta Title :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_title', @$blog_info->meta_title, ['class' => 'form-control  ', 'id' => 'meta_title', 'rows' => 3, 'placeholder' => 'Meta Title', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_title')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div
                                        class="form-group row {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_description', 'Meta Description :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_description', @$blog_info->meta_description, ['class' => 'form-control  ', 'id' => 'meta_description', 'rows' => 3, 'placeholder' => 'Meta Description', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_description')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group row {{ $errors->has('meta_keyword') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_keyword', 'Meta Keyword :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_keyword', @$blog_info->meta_keyword, ['class' => 'form-control  ', 'id' => 'meta_keyword', 'rows' => 3, 'placeholder' => 'Meta Keyword', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_keyword')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group row {{ $errors->has('meta_keyphrase') ? 'has-error' : '' }}">
                                        {{ Form::label('meta_keyphrase', 'Meta Keyphrase :', ['class' => 'col-sm-12']) }}
                                        <div class="col-sm-12">
                                            {{ Form::textarea('meta_keyphrase', @$blog_info->meta_keyphrase, ['class' => 'form-control  ', 'id' => 'meta_keyphrase', 'rows' => 3, 'placeholder' => 'Meta Keyphrase', 'required' => true, 'style' => 'width:80%; resize:none']) }}
                                            @error('meta_keyphrase')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12  ">
                            {{-- <div class="form-group row {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            {{ Form::label('category_id', 'Categories :*', ['class' => 'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::select('category_id[]',
                                @$categories,
                                @$selectedcategories,
                                ['id' => 'category_id', 'required' => false, 'class' => 'form-control select2', 'multiple' => true, 'style' => 'width:80%']) }}
                                @error('category_id')
                                <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                            <div class="form-group row">
                                {{ Form::label('featured_img', 'Featured Image:*', ['class' => 'col-sm-12']) }}
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="featured_img_button" data-input="featured_img"
                                            data-preview="featured_img_holder" class="global-btn" style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                            Choose
                                        </a>
                                    </span>
                                    <input id="featured_img" class="form-control" type="text" name="featured_img">
                                </div>
                                <div id="featured_img_holder" style="margin-top:15px;max-width: 100%;">
                                    <img src="" alt="" style="max-width: 100%">
                                </div>
                                @if (isset($blog_info->featured_img))
                                    Old Image: &nbsp; <img src="{{ $blog_info->featured_img }}" alt="Couldn't load image"
                                        class="img img-thumbail mt-2" style="width: 100px">
                                @endif
                            </div>
                            <div class="form-group row">
                                {{ Form::label('parallex_img', 'Parallex Image:*', ['class' => 'col-sm-12']) }}
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="parallex_img_button" data-input="parallex_img"
                                            data-preview="parallex_img_holder" class="global-btn" style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                            Choose
                                        </a>
                                    </span>
                                    <input id="parallex_img" class="form-control" type="text" name="parallex_img">
                                </div>
                                <div id="parallex_img_holder" style="margin-top:15px;max-width: 100%;">
                                    <img src="" alt="" style="max-width: 100%">
                                </div>
                                @if (isset($blog_info->parallex_img))
                                    Old Image: &nbsp; <img src="{{ $blog_info->parallex_img }}" alt="Couldn't load image"
                                        class="img img-thumbail mt-2" style="width: 100px">
                                @endif
                            </div>

                            <div class="form-group row {{ $errors->has('publish_status') ? 'has-error' : '' }}">
                                {{ Form::label('publish_status', 'Publish Status :*', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::select('publish_status', [1 => 'Yes', 0 => 'No'], @$blog_info->publish_status, ['id' => 'publish_status', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publish_status')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                {{ Form::label('', '', ['class' => 'col-sm-12']) }}
                                <div class="col-sm-12">
                                    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'global-btn mr-1', 'type' => 'submit']) }}
                                    {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'global-btn', 'type' => 'reset']) }}
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
