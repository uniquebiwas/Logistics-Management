@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    {{-- <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/zonal.js') }}"></script> --}}

    <script>

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
                        <a href="{{ route('zonal.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                        {{ Form::open(['url' => route('zonal-import-store'), 'files' => true, 'class' => 'form', 'name' => 'zonal_form']) }}
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="col-sm-10 offset-lg-1">




                            <div class="form-group row {{ $errors->has('serviceagent_id') ? 'has-error' : '' }}">
                                {{ Form::label('serviceagent_id', 'Service Agent *', ['class' => 'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('serviceagent_id', @$serviceAgents, @$zonal_info->serviceagent_id, ['class' => 'form-control', 'placeholder' => 'Select Service Agent', 'id' => 'serviceagent_id', 'style' => 'width:80%']) }}
                                    @error('serviceagent_id')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pricing " class="col-sm-3">Pricing Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" name="excelFile" id="pricing"
                                        placeholder="Import Your Pricing Here" aria-describedby="fileHelpId"
                                        style="width: 80%;">
                                    @error('excelFile')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'global-btn', 'type' => 'submit']) }}
                            {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'global-btn', 'type' => 'reset']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
