@extends('layouts.admin')
@section('title', $title)
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('membership.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'btn btn-primary btn-flat btn-sm', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools float-right">
                                <a href="{{ route('wallet.index') }}" class="btn btn-success btn-flat mr-2">
                                    <i class="fa fa-wallet mr-2"></i> <strong>Rs. {{ @$wallet_balance }}</strong> </a>
                            </div>
                        </div>
                    </div>
                </div>

                @isset($packages)
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">

                        @foreach ($packages as $key => $value)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            Amount: {{ @$value->package_amount }}
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>{{ @$value->title['en'] }}</b></h2>
                                                    <p class="text-muted text-sm">
                                                        {!! @$value->description['en'] !!}
                                                    </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small mb-1">
                                                            <span class="fa-li"><i class="fas fa-calendar"></i></span>
                                                            Max Requests / Year : {{ @$value->yearly_max_request }}
                                                        </li>
                                                        <li class="small">
                                                            <span class="fa-li"><i class="fas fa-edit"></i></span>
                                                            Last Updated At: {{ $value->updated_at ? @$value->updated_at->format('Y-m-d') : '-' }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{ $value->image_url }}" alt="{{ @$value->title['en'] }}"
                                                        class="img img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                {{ Form::open(['method' => 'POST', 'route' => ['agent.buyMembership', @$value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to buy this Membership?")']) }}
                                                {{ Form::button('<i class="fa fa-shopping-cart ml-1"></i> Buy Now', ['class' => 'btn btn-primary btn-sm btn-flat', 'type' => 'submit', 'title' => 'Buy Membership ']) }}
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="pagination-sm m-0 float-right">{{ $packages->links() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </div>

                @endisset
            </div>
        </div>
    </section>
@endsection
