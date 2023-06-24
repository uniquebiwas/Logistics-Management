@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Update Organizational Documents</h3>

                            <div class="card-tools">

                                <a href="{{ route('sendDocuments') }}" class="btn btn-success btn-sm btn-flat mr-2">

                                    <i class="fa fa-plus"></i> Submit Documents
                                </a>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body card-format">
                                {!! Form::open(['url' => route('sendDocuments'), 'method' => 'post', 'files' => true]) !!}

                                <div class="form-group row @error('name') has-error @enderror">
                                    @if (!isset($company_registration) || !$company_registration->verifiedAt)
                                        <div class="col-sm-6">
                                            {{ Form::label('company_registration', 'Company Registration Document:*', ['class' => '']) }}
                                            {{ Form::file('company_registration', @$profile->name['en'], ['class' => 'form-control form-control', 'id' => 'name', 'placeholder' => 'Company Registration Document', 'required' => true, 'style' => 'width:80%']) }}
                                            @error('company_registration')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            @if (isset($company_registration))
                                                {!! getEventProgramFileThumb($company_registration->file_path) !!}

                                            @endif
                                        </div>

                                    @endif
                                    @if (!isset($owner_citizenship) || !$owner_citizenship->verifiedAt)
                                        <div class="col-sm-6">
                                            {{ Form::label('owner_citizenship', 'Owner Citizenship Document:*', ['class' => '']) }}
                                            {{ Form::file('owner_citizenship', @$profile->name['en'], ['class' => 'form-control form-control', 'id' => 'name', 'placeholder' => 'Company Registration Document', 'required' => true, 'style' => 'width:80%']) }}
                                            @error('owner_citizenship')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            @if (isset($owner_citizenship))
                                                {!! getEventProgramFileThumb($company_registration->file_path) !!}

                                            @endif
                                        </div>

                                    @endif
                                    @if (!isset($pan_registration_document) || !$pan_registration_document->verifiedAt)
                                        <div class="col-sm-6">
                                            {{ Form::label('pan_registration_document', 'Pan registration document*', ['class' => '']) }}
                                            {{ Form::file('pan_registration_document', @$profile->name['en'], ['class' => 'form-control form-control', 'id' => 'name', 'placeholder' => 'Tax registration document', 'required' => true, 'style' => 'width:80%']) }}
                                            @error('pan_registration_document')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            @if (isset($pan_registration_document))
                                                {!! getEventProgramFileThumb($pan_registration_document->file_path) !!}

                                            @endif
                                        </div>
                                    @endif
                                    @if (!isset($tax_clarance) || !$tax_clarance->verifiedAt)
                                        <div class="col-sm-6">
                                            {{ Form::label('tax_clarance', 'Tax clearance document:*', ['class' => '']) }}
                                            {{ Form::file('tax_clarance', @$profile->name['en'], ['class' => 'form-control form-control', 'id' => 'name', 'placeholder' => 'Tax clarance document', 'required' => true, 'style' => 'width:80%']) }}
                                            @error('tax_clarance')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            @if (isset($tax_clarance))
                                                {!! getEventProgramFileThumb($tax_clarance->file_path) !!}

                                            @endif
                                        </div>
                                        @endif
                                            @if (!isset($share_document) || !$share_document->verifiedAt)
                                                <div class="col-sm-6">
                                                    {{ Form::label('share_document', 'Share Lagat:*', ['class' => '']) }}
                                                    {{ Form::file('share_document', @$profile->name['en'], ['class' => 'form-control form-control', 'id' => 'name', 'placeholder' => 'Tax clarance document', 'required' => true, 'style' => 'width:80%']) }}
                                                    @error('share_document')
                                                        <span
                                                            class="help-block error"><small>{{ $message }}</small></span>
                                                    @enderror
                                                    @if (isset($share_document))
                                                        {!! getEventProgramFileThumb($share_document->file_path) !!}

                                                    @endif
                                                </div>
                                            @endif
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    {{ Form::label('', '', ['class' => 'col-sm-7']) }}
                                                    <div class="col-sm-12">
                                                        {{ Form::button('Submit', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
