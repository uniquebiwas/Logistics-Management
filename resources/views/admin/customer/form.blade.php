@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/customer.js') }}"></script>
        <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script>
            $('#lfm').filemanager('image');

        </script>
    @endpush
@section('content')

    @php
    $agent = false;
    $index = route('customers.index');
    if (isset($customer_info)) {
        $update = route('customers.update', $customer_info->id);
    } else {
        $store = route('customers.store');
    }
    if (request()->is('agent/customer*')) {
        $agent = true;
        $index = route('customer.index');
        if (isset($customer_info)) {
            $update = route('customer.update', $customer_info->id);
        } else {
            $store = route('customer.store');
        }
    }
    @endphp
    @include('admin.shared.image_upload')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ $index }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($customer_info))
                        {{ Form::open(['url' => $update, 'files' => true, 'class' => 'form', 'name' => 'customer_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => $store, 'files' => true, 'class' => 'form', 'name' => 'customer_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="col-sm-10 offset-lg-1">
                            <div
                                class="form-group row {{ $errors->has('name') || $errors->has('email') ? 'has-error' : '' }}">
                                {{ Form::label('name', 'Customer Name*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('name', @$customer_info->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter customer name', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('name')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('email', 'Email :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::email('email', @$customer_info->email, ['id' => 'email', 'required' => true, 'placeholder' => 'Enter customer email', 'class' => 'form-control', 'style' => 'width:80%', 'disabled' => isset($customer_info) ? true : false]) }}
                                    @error('email')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('mobile') || $errors->has('address') ? 'has-error' : '' }}">
                                {{ Form::label('mobile', 'Mobile*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::number('mobile', @$customer_info->mobile, ['class' => 'form-control', 'id' => 'mobile', 'placeholder' => 'Enter customer mobile', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('mobile')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('address', 'Address :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('address', @$customer_info->address, ['id' => 'address', 'required' => true, 'placeholder' => 'Enter customer address', 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('address')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('city') || $errors->has('state') ? 'has-error' : '' }}">
                                {{ Form::label('city', 'City :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('city', @$customer_info->city, ['id' => 'city', 'required' => true, 'placeholder' => 'Enter customer city', 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('city')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('state', 'State*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::text('state', @$customer_info->state, ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'Enter customer state', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('state')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div
                                class="form-group row {{ $errors->has('zipcode') || $errors->has('country') ? 'has-error' : '' }}">
                                {{ Form::label('zipcode', 'Zipcode :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::number('zipcode', @$customer_info->zipcode, ['id' => 'zipcode', 'required' => true, 'placeholder' => 'Enter customer zipcode', 'class' => 'form-control', 'style' => 'width:80%']) }}
                                    @error('zipcode')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{ Form::label('country', 'Country*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-4">
                                    {{ Form::select('country', @$countries, @$customer_info->country, ['class' => 'form-control select2', 'id' => 'country', 'placeholder' => 'Select customer country', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('country')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'globa-btn', 'type' => 'submit']) }}
                            {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'globa-btn', 'type' => 'reset']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
