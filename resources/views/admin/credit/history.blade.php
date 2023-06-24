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
                    <h3 class="card-title">{{ $agent->company_name }} Credit History List</h3>
                    <div class="card-tools">
                        <a href="{{ route('agent-credit.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>

                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="card-tools">
                        <form action="" method="get">
                            <div class="row">

                                <div class="col-md-3">
                                    <input type="date" name="startDate" value="{{ request()->startDate }}"
                                        class="form-control form-control-sm" placeholder="Search">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="endDate" value="{{ request()->endDate }}"
                                        class="form-control form-control-sm" placeholder="Search">
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group-append">
                                        <button type="submit" class="view-btn">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>AgentCompany</th>
                                            <th>Owner</th>
                                            <th>Due Date</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Created At</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($data as $key => $credit)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $credit->agent_company }}</td>
                                                <td>{{ $credit->agentName }}</td>
                                                <td>{{ optional($credit->dueDate)->format('d-M-Y') }}</td>
                                                <td><span class="tag tag-success">{{ $credit->creditAmount }}</span>
                                                </td>
                                                </td>
                                                <td class="{{ $credit->type == 'credit' ? 'text-danger' : 'success' }}"
                                                    style="padding:4px 12px 5px;text-align:center;">
                                                    {{ @$credit->type }}
                                                </td>
                                                <td>{{ $credit->created_at->format('d-M-Y') }}</td>
                                                <td>
                                                    @can('agentcredit-edit')

                                                        <a href="{{ route('credit-history.edit', ['id' => $credit->id, 'type' => $credit->type]) }}"
                                                            title="Edit Credit" class="view-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                </td>
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
