@extends('layouts.admin')
@section('title', 'Agent')
@push('scripts')
    <script>
        $(function() {
            $('.start_date').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                minYear: 2018,
                startDate: "{{ @request()->start_date ?? date('Y/m/d') }}",
                maxYear: parseInt(moment().format('YYYY/MM/DD'), 10),
                locale: {
                    format: 'YYYY/MM/DD',
                }
            });
            $('.start_date').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD'));
            });
            $('.end_date').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD'));
            });
            $('.end_date').daterangepicker({
                singleDatePicker: true,
                minYear: 2018,
                autoUpdateInput: false,
                startDate: "{{ @request()->end_date ?? date('Y/m/d') }}",
                maxYear: parseInt(moment().format('YYYY/MM/DD'), 10),
                locale: {
                    format: 'YYYY/MM/DD',
                }
            });
        });
    </script>
@endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Agent List</h3>
                    <div class="card-tools">
                        <a href="{{ route('agents.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="p-1 col-lg-8">
                            <form action="" class="___class_+?12___">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Name, Email or Phone']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col sm-2">
                                        <div class="">
                                            {{ Form::text('start_date', @request()->start_date, ['class' => 'form-control form-control-sm start_date', 'placeholder' => 'Start Date', 'id' => 'start_date', 'rows' => 3]) }}
                                        </div>
                                    </div>
                                    <div class="
                                            col-lg-2 col-md-2 col sm-2">
                                            <div class="">
                                            {{ Form::text('end_date', @request()->end_date, ['class' => 'form-control form-control-sm end_date', 'placeholder' => 'End Date', 'id' => 'end_date', 'rows' => 3]) }}
                                        </div>
                                    </div>
                                    <div class="
                                                col-lg-2 col-md-2 col-sm-2">
                                                {{ Form::button('<i class="fa fa fa-search"></i>', ['class' => 'view-btn', 'type' => 'submit', 'title' => 'Search ']) }}
                                            </div>
                                        </div>
                            </form>
                        </div>
                        <div class="p-1 col-lg-4">
                            <div class="card-tools float-right">
                                @can('agents-create')
                                    <a href="{{ route('agents.create') }}" class="global-btn">
                                        <i class="fa fa-plus"></i> Add Agent</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">S.n</th>
                                <th>Company</th>
                                <th>Owner Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th style="text-align:center;" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                {{-- {{ dd($value->image) }} --}}
                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ $value->agent_profile->company_name }}</td>
                                    <td>{{ @$value->name['en'] }} </td>
                                    <td>{{ @$value->mobile ?? '-' }}</td>
                                    <td>{{ @$value->email ?? '-' }}</td>
                                    {{-- <td>
                            <img src="{{ asset('uploads/photos/thumbs/'.@$value->image)}}" alt="{{ @$value->title['en']}}" class="img img-thumbail" style="width:60px">
                        </td> --}}
                                    <td>
                                        {{ ReadableDate(@$value->created_at, 'all') }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge @isset($value->emailVerifiedAt) btn btn-success @else badge-danger @endisset"
                                            style="margin-top:3px;">
                                            Email :@isset($value->emailVerifiedAt)
                                            {{ ReadableDate($value->emailVerifiedAt, 'all') }} @else Not Verified
                                            @endisset
                                        </span> <br>
                                        <span
                                            class="badge @isset($value->phoneVerifiedAt) btn btn-success @else badge-danger @endisset"
                                            style="margin-top:3px;">
                                            Phone :@isset($value->phoneVerifiedAt)
                                            {{ ReadableDate($value->phoneVerifiedAt, 'all') }} @else Not Verified
                                            @endisset
                                        </span> <br>
                                        <span
                                            class="badge @isset($value->documentVerifiedAt) btn btn-success @else badge-danger @endisset"
                                            style="margin-top:3px;">
                                            Document :@isset($value->documentVerifiedAt)
                                            {{ ReadableDate($value->documentVerifiedAt, 'all') }} @else Not Verified
                                            @endisset
                                        </span> <br>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group mb-1">
                                            @can('agent-edit')
                                                @if (!$value->documentVerifiedAt)
                                                    {{ Form::open(['method' => 'POST', 'route' => ['agents.verifyDocument', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to verify documents?")']) }}
                                                    {{ Form::button('<i class="fas fa-file"></i>', ['class' => 'view-btn mr-1', 'type' => 'submit', 'title' => 'Verify Document']) }}
                                                    {{ Form::close() }}
                                                @endif
                                                @if (!$value->emailVerifiedAt)
                                                    {{ Form::open(['method' => 'POST', 'route' => ['agents.verifyEmail', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to verify email?")']) }}
                                                    {{ Form::button('<i class="fas fa-envelope"></i>', ['class' => 'view-btn mr-1', 'type' => 'submit', 'title' => 'Verify Email']) }}
                                                    {{ Form::close() }}
                                                @endif
                                                @if (!$value->phoneVerifiedAt)
                                                    {{ Form::open(['method' => 'POST', 'route' => ['agents.verifyPhone', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to verify phone?")']) }}
                                                    {{ Form::button('<i class="fas fa-phone"></i>', ['class' => 'view-btn mr-1', 'type' => 'submit', 'title' => 'Verify Phone']) }}
                                                    {{ Form::close() }}
                                                @endif
                                            @endcan
                                            <div class="btn-group grp-btn">
                                                @can('agent-credit-add')
                                                    <a href="{{ route('agent-credit.create', ['userId' => $value->id]) }}"
                                                        title="AgentCredit" class="view-btn"><i
                                                            class="fas fa-credit-card"></i></a>
                                                @endcan
                                                @can('agent-list')
                                                    <a href="{{ route('agents.show', $value->id) }}" title="View agent"
                                                        class="view-btn"><i class="fas fa-eye"></i></a>
                                                @endcan
                                                @can('agent-edit')
                                                    <a href="{{ route('agents.edit', $value->id) }}" title="Edit agent"
                                                        class="view-btn"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('agent-delete')
                                                    {{ Form::open(['method' => 'DELETE', 'route' => ['agents.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this agent?")']) }}
                                                    {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'view-btn mr-1', 'type' => 'submit', 'title' => 'Delete agent ']) }}
                                                    {{ Form::close() }}
                                                @endcan
                                               @hasanyrole('Super Admin')
                                               @include('admin.users._changeEmail')
                                               @endhasanyrole
                                                <br>
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
