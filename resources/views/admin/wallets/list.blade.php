@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        <script>
            $(".select2").select2();

        </script>
    @endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('wallets.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-7">
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::select('agent', @$agent, @request()->agent, ['class' => 'form-control form-control-sm select2', 'placeholder' => 'Search Title']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4">
                                        <button class="btn btn-sm btn-primary btn-flat"><i
                                                class="fa fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-striped table-hover"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Agent Name</th>
                                <th>Requested Amount</th>
                                @if (request()->is('nd-admin/wallets*'))
                                    <th>Approved Amount</th>
                                @endif
                                <th>Status </th>
                                <th>Gateway</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>#{{ @$value->id }}</td>
                                    <td>{{ ReadableDate(@$value->created_at, 'all') }}</td>
                                    <td>{{ @$value->get_agent->name['en'] }}</td>
                                    <td>{{ number_format(@$value->amount, 2) }}</td>
                                    @if (request()->is('nd-admin/wallets*'))
                                        <td>{{ $value->approved_amount ? number_format($value->approved_amount, 2) : '-' }}</td>
                                    @endif
                                    <td>
                                        <span
                                            class="badge badge-{{ @$value->status == 'verified' ? 'success' : 'info' }}">{{ ucFirst(@$value->status) }}</span>
                                    </td>
                                    <td>{{ @$value->paymentGateway }}</td>

                                    <td>
                                        <div class="btn-group">
                                            @if (@$value->status != 'verified')
                                                @can('wallet-edit')
                                                    <a href="{{ route('wallets.edit', $value->id) }}" title="Edit wallet"
                                                        class="btn btn-info btn-sm btn-flat">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan
                                            @else
                                                <a href="{{ route('wallets.show', $value->id) }}" title="Edit wallet"
                                                    class="btn btn-success btn-sm btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
                                            @can('wallet-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['wallets.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this wallet?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete wallet ']) }}
                                                {{ Form::close() }}
                                            @endcan
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
                                    Showing <strong>{{ $data->firstItem() }}</strong> to
                                    <strong>{{ $data->lastItem() }} </strong> of <strong>
                                        {{ $data->total() }}</strong>
                                    entries
                                    <span> | Takes <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b> seconds to
                                        render</span>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <span class="pagination-sm m-0 float-right">{{ $data->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
