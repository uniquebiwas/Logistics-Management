@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/shipmentcancellationreason.js') }}"></script>
        <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script>
            $('#lfm').filemanager('image');

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
                        <a href="{{ route('shipmentcancellationreason.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($cancellationReason_info))
                        {{ Form::open(['url' => route('shipmentcancellationreason.update', $cancellationReason_info->id), 'files' => true, 'class' => 'form', 'name' => 'shipmentcancellationreason_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('shipmentcancellationreason.store'), 'files' => true, 'class' => 'form', 'name' => 'shipmentcancellationreason_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="col-sm-10 offset-lg-1">
                            <div
                                class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
                                {{ Form::label('title', 'Reason Title*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::text('title', @$cancellationReason_info->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Reason Title', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('publishStatus') ? 'has-error' : '' }}">
                                {{ Form::label('publishStatus', 'Publish Status :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('publishStatus', [true => 'Yes', false => 'No'], @$cancellationReason_info->publishStatus, ['id' => 'publishStatus', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publishStatus')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('usage_by') ? 'has-error' : '' }}">
                                {{ Form::label('usage_by', 'Used By :*', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('usage_by', [true => 'Admin', false => 'Agent'], @$cancellationReason_info->usage_by, ['id' => 'usage_by', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('usage_by')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
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
