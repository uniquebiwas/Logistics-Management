@extends('layouts.admin')
@section('title', 'Credit History')

@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Credit History</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-capitalize">
                                                <th>S.N</th>
                                                <th>Due Date</th>
                                                <th>Credit Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse ($data as $key => $credit)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $credit->dueDate->format('d-m-Y') }}</td>
                                                    <td><span class="tag tag-success">{{ $credit->creditAmount }}</span></td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-bold">No Data Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->

                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1">
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
