@extends('layouts.admin')
@section('title', 'Customers')
@section('content')

    @php
    $agent = false;
    $create = route('customers.create');
    $index = route('customers.index');
    if (request()->is('agent/customer*')) {
        $agent = true;
        $create = route('customer.create');
        $index = route('customer.index');
    }
    @endphp
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer List</h3>
                    <div class="card-tools">
                        <a href="{{ $index }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search name']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools float-right">
                                <a href="{{ $create }}" class="global-btn mr-2">
                                    <i class="fa fa-plus"></i> Add Customer</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered"> {{-- table-bordered --}}
                        <thead>
                            <tr>
                                <th style="width: 10px">S.n</th>
                                <th>Name</th>
                                <th>Customer Id</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zipcode</th>
                                <th>Country</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                {{-- {{ dd($value->image) }} --}}
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->name }}</td>
                                    <td>{{ $value->customerId }}</td>
                                    <td>{{ @$value->mobile }}</td>
                                    <td>{{ @$value->email }}</td>
                                    <td>{{ @$value->address }}</td>
                                    <td>{{ @$value->city }}</td>
                                    <td>{{ @$value->state }}</td>
                                    <td>{{ @$value->getCountry->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href=" @if ($agent && $value->created_by ==
                                                auth()->user()->id) {{ route('customer.edit', $value->id) }}

                                            @else
                                                {{ route('customers.edit', $value->id) }} @endif"
                                                title="Edit customer"
                                                class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                            @can('customer-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['customer.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this customer?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete customer ']) }}
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
