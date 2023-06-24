@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header mt-0 pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-3">
                    <div class="card card-primary">
                        <div class="card-body box-profile">
                            <div class="text-center">

                            </div>

                            <h3 class="profile-username text-center btn btn-info">NPR. {{  @$balance->balance ?? 0 }}</h3>
                            <h2>Wallet Balance </h2>

                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">{{ $title }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">


                            </div>
                            <div class="col-md-12">
                                {{-- <h5 class="text-primary">{{ $title }} information</h5> --}}
                                <p class="text-sm">Currently, We accept bank transfer. You can upload clear scanned image of bank deposit voucher here.</p>
                                <hr>
                                <div class="m-0">
                                    {{ Form::open(['url' => $url, 'files' => true, 'class' => 'form']) }}
                                    @if(@$transactionInfo)
                                        @method('put')
                                    @endif

                                    <div class="form-group row @error('amount') has-error @enderror">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            {{ Form::label('amount', 'Deposited Amount:*', ['class' => '']) }}
                                            {{ Form::number('amount', @$transactionInfo->amount, ['class' => 'form-control form-control', 'id' => 'amount', 'placeholder' => 'Deposited Amount', 'required' => true, 'style' => 'width:80%' ]) }}
                                            @error('amount')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row @error('transactionId') has-error @enderror">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            {{ Form::label('transactionId', 'Transaction / Voucher No.:*', ['class' => '']) }}
                                            {{ Form::text('transactionId',@$transactionInfo->transactionId, ['class' => 'form-control form-control', 'id' => 'transactionId', 'placeholder' => 'Transaction / Voucher No.', 'required' => true, 'style' => 'width:80%' ]) }}
                                            @error('transactionId')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row @error('scanned_voucher') has-error @enderror">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            {{ Form::label('scanned_voucher', 'Upload Scanned voucher copy :*', ['class' => '']) }}
                                            {{ Form::file('scanned_voucher', null, ['class' => 'form-control form-control', 'id' => 'address', 'placeholder' => 'Upload Scanned voucher copy',  'style' => 'width:80%' ]) }}
                                            @error('scanned_voucher')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                            {{-- {{ dd($transactionInfo) }} --}}
                                            @if(isset($transactionInfo) && @$transactionInfo->image)
                                            <div class="row">
                                                <div class="col-lg-4">

                                                    {!! getEventProgramFileThumb($transactionInfo->image) !!}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row @error('remarks') has-error @enderror">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            {{ Form::label('remarks', 'Remark:*', ['class' => '']) }}
                                            {{ Form::text('remarks', @$transactionInfo->remarks, ['class' => 'form-control form-control', 'id' => 'remarks', 'placeholder' => 'Remark', 'required' => true, 'style' => 'width:80%' ]) }}
                                            @error('remarks')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row @error('paymentGateway') has-error @enderror">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-11">
                                            {{ Form::label('paymentGateway', 'Payment Gateway:*', ['class' => '']) }}
                                            {{ Form::select('paymentGateway',['bank' => "Bank", 'esewa' => "Esewa", 'khalti' => 'Khalti', 'imepay' => "IMEPay"],@$transactionInfo->paymentGateway , ['class' => 'form-control form-control', 'id' => 'paymentGateway', 'placeholder' => 'Payment Gateway', 'required' => true, 'style' => 'width:80%' ]) }}
                                            @error('paymentGateway')
                                                <span class="help-block error"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{ Form::label('', '', ['class' => 'col-sm-7']) }}
                                        <div class="col-sm-5">
                                            {{ Form::button(" Submit", ['class' => 'btn btn-primary', 'type' => 'submit']) }}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
