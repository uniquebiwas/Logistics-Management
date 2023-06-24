@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        <script>
            $("#amount_input").hide();
            $('#updateBalance').change(function() {
                var type = $(this).val();
                if (type != '0') {
                    $("#amount_input").show();
                } else {
                    $("#amount_input").hide();
                }
            });

        </script>

    @endpush
@section('content')
    @include('admin.shared.image_upload')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3>Name Of Agent : {{ @$agentInfo->name['en'] }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Contact No : {{ @$agentInfo->mobile }}</h4>
                            <h4>Email Address: {{ @$agentInfo->email }}</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="">
                                <h3>Account Balance : <strong>NPR {{ $balance }} </strong></h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('wallets.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($wallet_info))
                        {{ Form::open(['url' => route('updateBalance', $wallet_info->id), 'files' => true, 'class' => 'form', 'name' => 'wallets_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('wallets.store'), 'files' => true, 'class' => 'form', 'name' => 'wallets_form']) }}
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('Requested Amount', 'Requested Amount', ['']) !!}

                            {!! Form::text('amount', "NPR.$wallet_info->amount", ['id' => 'amount', 'class' => 'form-control form-control-sm', 'disabled' => true]) !!}

                            {!! Form::label('updateBalance', 'Amount to Update', ['']) !!}

                            {!! Form::select('updateBalance', ['0' => 'Update Requested Amount', '1' => 'Input Amount'], null, ['id' => 'updateBalance', 'class' => 'form-control form-control-sm']) !!}
                            <div id="amount_input">
                                {!! Form::label('balance', 'Enter Amount', ['']) !!}
                                {!! Form::number('balance', $wallet_info->amount, ['id' => 'balance', 'class' => 'form-control form-control-sm']) !!}
                            </div>
                            <div class="form-group row p-2">
                                {{ Form::button("<i class='fa fa-paper-plane'></i> Update Wallet", ['class' => 'btn btn-success btn-flat btn-sm mt-2', 'type' => 'submit']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- Image --}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12 p-3" id="holder" style="height:100px;max-width:100px">
                                            <a href="{{ asset(lcfirst(@$wallet_info->image)) }}" target="_blank">
                                                <img src='{{ asset(lcfirst(@$wallet_info->image)) }}' alt=""
                                                    class="img-responsive img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
