@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3>Agent Name : <strong> {{ $wallet_info->get_agent->name['en'] }}</strong></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Contact No : <strong> {{ $wallet_info->get_agent->mobile ?? 'N/A' }}</strong></p>
                            <p>Email Address: <strong> {{ $wallet_info->get_agent->email ?? 'N/A' }}</strong></p>
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div><strong>Requested Amount  </strong>: <br> NPR. {{ @$wallet_info->amount }}</div>
                        </div>
                        <div class="col-lg-6">
                            <div><strong>Uploaded Balance  </strong>: <br> NPR. {{ @$wallet_info->approved_amount }}</div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <strong>Requested Date </strong> : {{  ReadableDate(@$wallet_info->created_at, 'all') }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <strong>Updated Date </strong> : {{  ReadableDate(@$wallet_info->updated_at, 'all') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
