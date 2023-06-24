@extends('layouts.admin')
@section('title', @$title)
@push('scripts')
@endpush
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username">{{ @$agent_info->agent_profile->company_name }}</h3>
                            <h5 class="widget-user-desc">Agent</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                src="{{ @$agent_info->profileImage ?? asset('/images/placeholder.png') }}"
                                alt="{{ @$agent_info->name['en'] }}">
                        </div>
                        <div class="card-footer bg-white">
                            <ul class="list-group list-group-unbordered mb-3 agent-pf">
                                <li class="list-group-item">
                                    <b>Phone Verified</b> <a class=" @if ($agent_info->phoneVerifiedAt) text-success @else text-warning @endif">
                                        @if ($agent_info->phoneVerifiedAt) <i
                                                class="fas fa-check"></i>
                                            {{ ReadableDate($agent_info->phoneVerifiedAt, 'ymd') }}@else <i
                                                class="fas fa-window-close"></i> @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email Verified</b> <a class=" @if ($agent_info->emailVerifiedAt) text-success @else text-warning @endif">
                                        @if ($agent_info->emailVerifiedAt) <i
                                                class="fas fa-check"></i>
                                            {{ ReadableDate($agent_info->emailVerifiedAt, 'ymd') }}@else <i
                                                class="fas fa-window-close"></i> @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Document Verified</b> <a class=" @if ($agent_info->documentVerifiedAt) text-success @else text-warning @endif">
                                        @if ($agent_info->documentVerifiedAt) <i
                                                class="fas fa-check"></i>
                                            {{ ReadableDate($agent_info->documentVerifiedAt, 'ymd') }}@else <i
                                                class="fas fa-window-close"></i> @endif
                                    </a>
                                </li>
                            </ul>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Agent Details</h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <ul class="nav nav-pills table-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#documents"
                                        data-toggle="tab">Documents</a></li>
                                <li class="nav-item"><a class="nav-link" href="#profile"
                                        data-toggle="tab">Profile</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#company"
                                        data-toggle="tab">Company</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="documents">

                                    @if (!$agent_info->documentVerifiedAt)
                                        <div class="col-lg-12">
                                            {{ Form::button('Request Document', ['class' => 'float-right btn btn-primary btn-sm btn-flat', 'data-toggle' => 'modal', 'data-target' => '#documentRequestModal', 'title' => 'Request Document']) }}
                                            {{ Form::open(['method' => 'POST', 'route' => ['agents.verifyDocument', $agent_info->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to verify all documents?")']) }}
                                            {{ Form::button('<i class="fas fa-file mr-1"></i> Verify All Documents', ['class' => 'btn btn-success btn-sm btn-flat', 'type' => 'submit', 'title' => 'Verify All Document']) }}
                                            {{ Form::close() }}
                                        </div>
                                    @endif
                                    <div style="overflow-x: scroll">
                                        <table class="table table-bordered"> {{-- table-bordered --}}
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">S.n</th>
                                                    <th>Document Type</th>
                                                    <th>Verified At</th>
                                                    <th>Verified By</th>
                                                    <th>Status</th>
                                                    <th style="text-align:center;" width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}.</td>
                                                        <td>{{ @$value->documentType ?? '-' }}</td>
                                                        <td>{{ @$value->verifiedAt ?? '-' }}</td>
                                                        <td>{{ @$value->verifier->name['en'] ?? '-' }}</td>
                                                        <td>
                                                            <span
                                                                class="badge @if ($value->status == 'requested') badge-warning
                                                            @elseif($value->status == 'unverified')
                                                                badge-danger
                                                            @elseif($value->status == 'verified')
                                                            badge-success @else badge-secondary @endif">
                                                                @if ($value->status == 'requested') Requested
                                                                @elseif($value->status == 'unverified') Unverified
                                                            @elseif($value->status == 'verified') Verified @else
                                                                Unknown @endif
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ asset(@$value->documentPath) ?? '#' }}"
                                                                title="View Document"><button
                                                                    class="btn btn-primary btn-sm btn-flat"><i
                                                                        class="fas fa-eye"></i></button></a>
                                                            @if ($value->status == 'requested' || $value->status == 'unverified')
                                                                @can('workerdocument-edit')
                                                                    {{ Form::open(['method' => 'POST', 'route' => ['agent.document.verify', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to verify this document?")']) }}
                                                                    {{ Form::button('<i class="fas fa-check"></i>', ['class' => 'btn btn-success btn-sm btn-flat', 'type' => 'submit', 'title' => 'Verify Document ']) }}
                                                                    {{ Form::close() }}
                                                                @endif
                                                                {{-- @if ($value->status == 'unverified')
                                                                    {{ Form::open(['method' => 'POST', 'route' => ['workerdocument.request', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to request this document again?")']) }}
                                                                    {{ Form::button('<i class="fas fa-undo"></i>', ['class' => 'btn btn-warning btn-sm btn-flat', 'type' => 'submit', 'title' => 'Request Document Again ']) }}
                                                                    {{ Form::close() }}
                                                                @endcan --}}
                                                @endif
                                                {{-- @can('workerdocument-delete')
                                                                {{ Form::open(['method' => 'DELETE', 'route' => ['workerdocument.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this document?")']) }}
                                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete Slider ']) }}
                                                                {{ Form::close() }}
                                                            @endcan --}}
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
                                                        {{ $data->total() }}</strong> entries
                                                    <span> | Takes
                                                        <b>{{ round(microtime(true) - LARAVEL_START, 2) }}</b>
                                                        seconds to render</span>
                                                </p>
                                            </div>
                                            <div class="col-md-8">
                                                <span class="pagination-sm m-0 float-right">{{ $data->links() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane" id="profile">


                                <!-- About Me Box -->
                                <div class="card card-primary text-center">
                                    <div class="card-header widget-user-header bg-info">
                                        <h3 class="widget-user-username">{{ @$agent_info->name['en'] }}
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body text-left">
                                        <div class="col-6 float-left">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Email:
                                                    {{ @$agent_info->email }}</li>
                                                @if (@$agent_info->tempAddress)
                                                    <li class="list-group-item">Temporary Address: <a
                                                            href="{{ @$agent_info->tempAddress }}"></a>
                                                        {{ @$agent_info->tempAddress }} </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="col-6 float-right">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Phone:
                                                    {{ @$agent_info->mobile }}</li>
                                                @if (@$agent_info->permanentAddress)
                                                    <li class="list-group-item">Permanent Address: <a
                                                            href="{{ @$agent_info->permanentAddress }}"></a>
                                                        {{ @$agent_info->permanentAddress }} </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                            </div>
                            <div class="tab-pane" id="company">

                                <!-- About Me Box -->
                                <div class="card card-primary text-center">
                                    <div class="card-header widget-user-header bg-info">
                                        <h3 class="widget-user-username">{{ @$agent_info->agent_profile->company_name }}
                                        </h3>
                                    </div>
                                    <div class="widget-user-image mt-4">
                                        <img class="img-circle elevation-2"
                                            src="{{ @$agent_info->agent_profile->company_logo_url ?? asset('/images/placeholder.png') }}"
                                            alt="{{ @$agent_info->agent_profile->company_name }}" style="height:300px;width:300px;margin:auto;">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body text-left">
                                        <div class="col-6 float-left">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Company Name:
                                                    {{ @$agent_info->agent_profile->company_name }}</li>
                                                <li class="list-group-item">Address:
                                                    {{ @$agent_info->agent_profile->address }}</li>
                                                <li class="list-group-item">City: {{ @$agent_info->agent_profile->city }}
                                                </li>
                                                @if (@$agent_info->agent_profile->facebook)
                                                    <li class="list-group-item">Facebook Link: <a
                                                            href="{{ @$agent_info->agent_profile->facebook }}"></a>
                                                        {{ @$agent_info->agent_profile->facebook }} </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="col-6 float-right">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Designation:
                                                    {{ @$agent_info->agent_profile->designation }}</li>
                                                <li class="list-group-item">State:
                                                    {{ @$agent_info->agent_profile->state }}</li>
                                                <li class="list-group-item">Country:
                                                    {{ @$agent_info->agent_profile->get_country->name }}</li>
                                                @if (@$agent_info->agent_profile->twitter)
                                                    <li class="list-group-item">Twitter Link: <a
                                                            href="{{ @$agent_info->agent_profile->twitter }}"></a>
                                                        {{ @$agent_info->agent_profile->twitter }} </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @if (!$agent_info->documentVerifiedAt)
        <!-- Modal -->
        <div class="modal fade" id="documentRequestModal" tabindex="-1" role="dialog"
            aria-labelledby="documentRequestModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Request Document from Agent</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ Form::open(['url' => route('agentdocument.request'), 'class' => 'form', 'name' => 'document_form']) }}
                    <div class="modal-body">
                        <div class="card-body">

                            <div class="form-group row {{ $errors->has('documentType') ? 'has-error' : '' }}">
                                {{ Form::label('documentType', 'Document Type:*', ['class' => 'col-12']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('documentType', DOCUMENT_TYPE, null, ['class' => 'form-control', 'id' => 'documentType', 'required' => true, 'style' => 'width:100%']) }}
                                    @error('documentType')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{ Form::hidden('agentId', @$agent_info->id) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                        {{ Form::button("<i class='fas fa-times'></i> Close", ['class' => 'btn btn-danger btn-flat', 'data-dismiss' => 'modal']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    @endif
@endsection
