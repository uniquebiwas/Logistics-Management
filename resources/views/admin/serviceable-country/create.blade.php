@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/user.js') }}"></script>
        <script>
            
            $(document).ready(function() {
                $('#countries').select2({
                    placeholder: "Serviceable Country",
                });
            });

        </script>
    @endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('users.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">


                    {{ Form::open(['url' => route('updateCountries'), 'files' => true, 'class' => 'form', 'name' => 'updateCountries_form']) }}

                    <div class="form-group row {{ $errors->has('countries') ? 'has-error' : '' }}">
                        {{ Form::label('countries', 'Countries:*', ['class' => 'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('countries[]', $all_countries, @$serviceable_country, ['id' => 'countries', 'required' => true, 'class' => 'form-control', 'multiple' => true, 'style' => 'width:80%']) }}
                            @error('countries')
                                <span class="help-block error">{{ $message }}</span>
                            @enderror
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
