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

                            <h3 class="profile-username text-center btn btn-info">NPR.
                                {{ number_format(@$balance->balance ?? 0) }}</h3>
                            <h2>Wallet Balance </h2>

                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold text-primary">Transaction History</h3>

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

                                {{-- <p class="text-sm">Recently we accept bank transfer , here you can upload bank diposit vochure  scanned  clear image </p> --}}
                                <hr>
                                <div style="overflow-x: scroll" class="card-body card-format">
                                    <table class="table table-striped table-hover"> {{-- table-bordered --}}
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th style="text-align:center;" width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $key => $transaction)
                                                {{-- {{ dd($value->image) }} --}}
                                                <tr>
                                                    <td>{{ $key + 1 }}.</td>
                                                    <td>{{ @$transaction->remarks }}</td>
                                                    <td>{{ number_format(@$transaction->amount, 2) }}</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-{{ @$transaction->status == 'verified' ? 'success' : 'info' }}">
                                                            {{ ucFirst(@$transaction->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ ReadableDate(@$transaction->created_at, 'all') }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            @if (@$transaction->status != 'verified')
                                                                <a href="{{ route('wallet.edit', $transaction->id) }}"
                                                                    title="Edit agent"
                                                                    class="btn btn-success btn-sm btn-flat"><i
                                                                        class="fas fa-edit"></i></a>

                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['wallet.destroy', $transaction->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this transaction?")']) }}
                                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete transaction ']) }}
                                                                {{ Form::close() }}
                                                            @endif

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="text-sm">
                                                    Showing <strong>{{ $transactions->firstItem() }}</strong> to
                                                    <strong>{{ $transactions->lastItem() }} </strong> of <strong>
                                                        {{ $transactions->total() }}</strong>
                                                    entries
                                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b>
                                                        seconds to
                                                        render</span>
                                                </p>
                                            </div>
                                            <div class="col-md-8">
                                                <span
                                                    class="pagination-sm m-0 float-right">{{ $transactions->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
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
