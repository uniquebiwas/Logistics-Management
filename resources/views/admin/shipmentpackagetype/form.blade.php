@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    @include('admin.section.ckeditor')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#image').filemanager('image');
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
                        <a href="{{ route('shipmentpackagetype.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($shipmentPackageType_info))
                        {{ Form::open(['url' => route('shipmentpackagetype.update', $shipmentPackageType_info->id), 'files' => true, 'class' => 'form', 'name' => 'shipmentpackagetype_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('shipmentpackagetype.store'), 'files' => true, 'class' => 'form', 'name' => 'shipmentpackagetype_form']) }}
                    @endif
                    <div class="form-group row">
                        <div class="col-2">
                            {{ Form::label('package_type', 'Package Type*') }} </div>
                        <div class="col-10">
                            {{ Form::text('package_type', @$shipmentPackageType_info->package_type, ['class' => 'form-control', 'id' => 'package_type', 'placeholder' => 'Service Agent package_type', 'required' => true]) }}
                            @error('package_type')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-2">
                            {{ Form::label('publishStatus', 'Publish Status :*') }}</div>
                        <div class="col-10">
                            {{ Form::select('publishStatus', [true => 'Yes', false => 'No'], @$shipmentPackageType_info->publishStatus, ['id' => 'publishStatus', 'required' => true, 'class' => 'form-control']) }}
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
        </div>
        </div>
    </section>
@endsection
