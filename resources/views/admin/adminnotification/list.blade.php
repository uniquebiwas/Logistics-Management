@extends('layouts.admin')
@section('title', 'Admin Notifications')
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin Notifications</h3>
                    <div class="card-tools">
                        <a href="{{ route('adminnotification.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="card-body search-body">
                    <div class="row">
                        <div class="col-6 col-md-9 col-sm-9">
                            <form action="" class="" autocomplete="off">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        {!! Form::text('keyword', @request()->keyword, ['class' => 'form-control form-control-sm', 'placeholder' => 'Search Name or Phone or Email Here']) !!}
                                    </div>
                                    <div class="col-lg-2 col-md-2 col sm-2">
                                        <div class="form-group">
                                            {{ Form::text('start_date', @request()->start_date, ['class' => 'form-control form-control-sm start_date', 'placeholder' => 'Start Date', 'id' => 'start_date', 'rows' => 3]) }}
                                            @error('start_date')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col sm-2">
                                        <div class="form-group">
                                            {{ Form::text('end_date', @request()->end_date, ['class' => 'form-control form-control-sm end_date', 'placeholder' => 'End Date', 'id' => 'end_date', 'rows' => 3]) }}
                                            @error('end_date')
                                                <span class="help-block error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <button class="view-btn">
                                            <i class="fa fa fa-search"></i>
                                            {{-- Filter --}}
                                        </button>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll" class="card-body card-format">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>Sender</th>
                                <th>Reciever</th>
                                <th>Status</th>
                                <th>Description</th>
                                {{-- <th style="text-align:center;" width="10%">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)

                                <tr>
                                    <td>{{ $key + 1 }}.</td>
                                    <td>{{ @$value->title }}</td>
                                    <td>{{ @$value->sender->name['en'] }}</td>
                                    <td>{{ @$value->reciever->name['en'] }}</td>
                                    <td>
                                        <span class="badge badge-{{ @$value->seen_at == null ? 'warning' : 'success' }}">
                                            {{ @$value->seen_at == null ? 'Unseen' : 'Seen at  '.ReadableDate(@$value->seen_at, 'all') }}
                                        </span>
                                    </td>
                                    <td style="max-width: 500px">{!! @$value->description !!}</td>
                                    {{-- <td>
                                        <div class="btn-group">
                                            {{ Form::button('<i class="fas fa-eye"></i>', ['id'=>'detailData','class' => 'float-right btn btn-primary btn-sm btn-flat', 'data-toggle' => 'modal', 'data-target' => '#notificationDetailModal', 'title' => 'Detail Info']) }}
                                            @can('user-delete')
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['adminnotification.destroy', $value->id], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to delete this Worker?")']) }}
                                                {{ Form::button('<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'type' => 'submit', 'title' => 'Delete Worker']) }}
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

    <!-- Modal -->
    <div class="modal fade" id="notificationDetailModal" tabindex="-1" role="dialog"
        aria-labelledby="notificationDetailModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Request Document from Worker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['url' => route('workerdocument.store'), 'class' => 'form', 'name' => 'document_form']) }}
                <div class="modal-body">
                    <div class="card-body">

                        <div class="form-group row {{ $errors->has('documentType') ? 'has-error' : '' }}">
                            {{ Form::label('documentType', 'Document Type:*', ['class' => 'col-12']) }}
                            <div class="col-sm-9">
                                {{ Form::text('documentType', null, ['class' => 'form-control', 'id' => 'documentType', 'placeholder' => 'Ex: Citizenship, Certificates', 'required' => true, 'style' => 'width:100%']) }}
                                @error('documentType')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{ Form::hidden('workerId', @$workerDetail->id) }}
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'global-btn', 'type' => 'submit']) }}
                    {{ Form::button("<i class='fas fa-times'></i> Close", ['class' => 'global-btn', 'data-dismiss' => 'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
