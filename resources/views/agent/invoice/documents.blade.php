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
                            <h3 class="card-title text-bold">Update Invoice Paid Documents</h3>

                            <div class="card-tools">

                                

                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body card-format">
                                {!! Form::open(['url' => route('invoice.documents.submit'), 'method' => 'post', 'files' => true]) !!}
                                <div class="form-group row @error('name') has-error @enderror">

                                    @if (!isset($document))
                                    <input type="hidden" value="{{$invoice->id}}" name="invoiceId">
                                        <div class="col-sm-6">
                                            {{ Form::label('document', 'Payment Document Upload:*', ['class' => '']) }}
                                            {{ Form::file('document',null, ['class' => 'form-control form-control', 'id' => 'name', 'required' => true, 'style' => 'width:80%']) }}
                                            @error('document')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                {{ Form::label('', '', ['class' => 'col-sm-7']) }}
                                                <div class="col-sm-12">
                                                    {{ Form::button('Submit', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                            @if (isset($document))
                                                {!! getEventProgramFileThumb($document->document) !!}

                                            @endif
                                   
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
