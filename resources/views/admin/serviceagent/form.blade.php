@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/serviceagent.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        $(document).ready(function() {
            $(".select2").select2();
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
                        <a href="{{ route('serviceagent.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($serviceAgent_info))
                        {{ Form::open(['url' => route('serviceagent.update', $serviceAgent_info->id), 'files' => true, 'class' => 'form', 'name' => 'serviceagent_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('serviceagent.store'), 'files' => true, 'class' => 'form', 'name' => 'serviceagent_form']) }}
                    @endif
                    <div class="form-group row">
                        <div class="col-2">
                            {{ Form::label('title', 'Service Agent Title*') }} </div>
                        <div class="col-10">
                            {{ Form::text('title', @$serviceAgent_info->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Service Agent Title', 'required' => true]) }}
                            @error('title')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- <<--------------------------->> --}}

                    <div class="form-group row">
                        <div class="col-2">
                            {{ Form::label('api_url', 'API URL*') }} </div>
                        <div class="col-10">
                            {{ Form::url('api_url', @$serviceAgent_info->api_url, ['class' => 'form-control', 'id' => 'api_url', 'placeholder' => 'Service Agent api_url', 'required' => true]) }}
                            @error('api_url')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-2">
                            {{ Form::label('publishStatus', 'Publish Status :*') }}</div>
                        <div class="col-10">
                            {{ Form::select('publishStatus', [true => 'Yes', false => 'No'], @$serviceAgent_info->publishStatus, ['id' => 'publishStatus', 'required' => true, 'class' => 'form-control']) }}
                            @error('publishStatus')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="offset-2 col-10">
                            <button type="submit" class="global-btn">Submit</button>
                            <button type="reset" class="global-btn">Reset</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
