@extends('layouts.admin')
@section('title', 'Credit To agent')
@push('scripts')
    <script>
        $('#agentId').select2();
    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="b-noti-col pl-none">
                <div class="b-noti-btn">
                    <div class="b-noti-left common-btns">
                        <a href="{{ route('agent-credit.create') }}" type="button" class="global-btn">
                            <i class="fas fa-credit-card"> </i>Create Credit</a>
                        <a href="{{ route('createAdvance') }}" type="button" class="global-btn">
                            <i class="fas fa-credit-card"></i>Create Advance</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Agent Credit List</h3>
                    <div class="card-tools">
                        <a href="{{ route('agent-credit.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        {!! Form::select('agentId', $agentList, request()->agentList, ['class' => 'form-control form-control-sm', 'id' => 'agentId', 'placeholder' => 'selectAgent']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="startDate" class="form-control form-control-sm"
                                            placeholder="Search">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="endDate" class="form-control form-control-sm"
                                            placeholder="Search">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-append">
                                                <button type="submit" class="view-btn">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-capitalize">
                                <th>S.n</th>
                                <th>Company</th>
                                <th>Extended Date</th>
                                <th>Due Date</th>
                                <th>Issued Credit</th>
                                <th>Remaining Credit</th>
                                <th>Consumed Credit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($data as $key => $credit)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $credit->agentCompany }}</td>
                                    <td>{{ $credit->last_extended_date->format('d-M-y') }}</td>
                                    <td>
                                        @include('admin.credit._dueDate',['credit'=>$credit])
                                    </td>
                                    <td>{{ $credit->issuedAmount }}</td>
                                    <td><span class="tag tag-success">{{ $credit->balance }}</span></td>
                                    <td><span class="tag tag-success">{{ $credit->consumedCredit }}</span>
                                    </td>
                                    </td>
                                    <td>
                                        @can('agent-credit-edit')
                                            <a href="{{ route('credit-history', $credit->agentId) }}" title="History"
                                                class="view-btn">
                                                <i class="fas fa-history"></i></a>
                                        @endcan

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-bold">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
