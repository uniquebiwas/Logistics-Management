@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2()
        })

    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }} List</h3>
                    <div class="card-tools">
                        <a href="{{ route('tag.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::select('keyword', @$boughtPackages, @request()->keyword, ['class' => 'form-control form-control-sm  select2']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'btn btn-primary btn-flat btn-sm', 'type' => 'submit', 'title' => 'Search ']) }}
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
                                @hasanyrole(admin())
                                <th>Agent</th>
                                @endhasanyrole
                                <th>Membership Package</th>
                                <th>Amount</th>
                                <th>Total Request</th>
                                <th>User Request</th>
                                <th>Cancelled Request</th>
                                <th>Remaining Requests</th>
                                <th>Purchased On</th>
                                {{-- <th style="text-align:center;" width="10%">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    @hasanyrole(admin())
                                    <td>{{ @$value->get_agent->name['en'] }}</td>
                                    @endhasanyrole
                                    <td>{{ @$value->get_package->title['en'] }}</td>
                                    <td>{{ @$value->totalAmount }}</td>
                                    <td>{{ @$value->totalRequest ?? '-' }}</td>
                                    <td>{{ @$value->usedRequest ?? '-' }}</td>
                                    <td>{{ @$value->cancelledRequest ?? '-' }}</td>
                                    <td>{{ @$value->remainingRequestCount ?? '-' }}</td>
                                    <td>{{ ReadableDate(@$value->created_at, 'all') }}</td>

                                    {{-- <td>
                                        <div class="btn-group">
                                            @can('tag-edit')
                                                <a href="{{ route('tag.edit', $value->id) }}" title="Edit Tag"
                                                    class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('tag-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['tag.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Tag?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete Tag ']) }}
                                                {{ Form::close() }}
                                            @endcan
                                        </div>
                                    </td> --}}
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
