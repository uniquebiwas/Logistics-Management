@extends('layouts.admin')
@section('title', 'partners')
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/member.js') }}"></script>
    <script>
        $('#MainImage').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                $('#thumbnail').removeClass('d-none');
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
                    <h3 class="card-title text-capitalize">partners Form</h3>
                    <div class="card-tools">
                        <a href="{{ route('partners.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($partner->id)
                        {!! Form::open(['url' => route('partners.update', $partner->id), 'class' => '']) !!}
                        @method('PATCH')

                    @else
                        {!! Form::open(['url' => route('partners.store'), 'class' => '']) !!}
                    @endif
                    @csrf
                    <div class="form-group">
                        {!! Form::label('title', 'Name') !!}
                        {!! Form::text('title', $partner->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'title', 'required' => 'true']) !!}

                        @error('title')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('url', 'Organization Url ') !!}
                        {!! Form::url('url', $partner->url, ['class' => 'form-control', 'id' => 'url', 'placeholder' => 'url']) !!}

                        @error('url')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('url', 'Organization Url ') !!}
                        {!! Form::select('publishStatus', ['1' => 'active', '0' => 'inactive'], $partner->publishStatus, ['class' => 'form-control', 'id' => 'publishStatus', 'placeholder' => 'Publish Status']) !!}
                        @error('publishStatus')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('filepath', 'Image') }}
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="MainImage" data-input="thumbnail" data-preview="holder" class="global-btn" style="height: 38px;line-height:29px;border-top-right-radius:0;border-bottom-right-radius:0;">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="image"
                                value="{{ $partner->image }}">
                        </div>
                        <div id="holder" style="margin-top:15px;max-width: 100%;">
                            <img src="{{ $partner->image }}" alt="" style="max-width: 100px">
                        </div>

                        @error('image')
                            <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <button type="submit" class="global-btn mr-2">Submit</button>
                        <button type="reset" class="global-btn">Reset</button>

                    </div>
                    {!! Form::close() !!}
                </div>

            </div>

        </div>
        </div>
    </section>
@endsection
