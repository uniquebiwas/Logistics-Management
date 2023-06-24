@extends('layouts.admin')
@section('title', $title)
@section('content')
    @include('admin.shared.image_upload')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('shipmentzone.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($shipmentZone_info))
                        {{ Form::open(['url' => route('shipmentzone.update', $shipmentZone_info->id), 'files' => true, 'class' => 'form', 'name' => 'shipmentzone_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('shipmentzone.store'), 'files' => true, 'class' => 'form', 'name' => 'shipmentzone_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="col-sm-10 offset-lg-1">
                            <div class="form-group row {{ $errors->has('title') ? 'has-error' : '' }}">
                                {{ Form::label('title', 'Zone Title*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::text('title', @$shipmentZone_info->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter Zone Title', 'required' => true, 'style' => 'width:80%', 'disabled' => isset($agent_info) ? true : false]) }}
                                    @error('title')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('serviceAgentId') ? 'has-error' : '' }}">
                                {{ Form::label('serviceAgentId', 'Service Agent*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('serviceAgentId', $serviceAgents, @$shipmentZone_info->serviceAgentId, ['id' => 'serviceAgentId', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('serviceAgentId')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('publishStatus') ? 'has-error' : '' }}">
                                {{ Form::label('publishStatus', 'Publish Status*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('publishStatus', [true => 'Yes', false => 'No'], @$shipmentZone_info->publishStatus, ['id' => 'publishStatus', 'required' => true, 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('publishStatus')
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
