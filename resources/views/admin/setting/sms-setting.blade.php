@extends('layouts.admin')
@section('title', 'Web SMS Setting')
    @push('styles')
        <style>
            .btn-default.active,.btn-default.active:hover {background-color: #17a2b8;border-color: #138192;color: #fff;}
        </style>
    @endpush
    @push('scripts')
        <script>
            $(document).ready(function(e) {
                UpdateMeta("{{ @$api_detail->status}}");
            });
            $("input[name=status]").change(function(e) {
                var status = $(this).val();
                UpdateMeta(status);
            });
            function UpdateMeta(status) {
                if (status == "0") {
                    $("div#metatag-details").hide();
                }
                if (status == "1") {
                    $("div#metatag-details").show();
                }
            }
        </script>
    @endpush
@section('content')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Web SMS Settings</h3>
                    <div class="card-tools">
                        <a href="{{ route('dashboard.index') }}" type="button" class="btn btn-tool"><i class="fa fa-list"></i></a>
                    </div>
                </div>
                @if(@$api_detail)
                    {{ Form::open(['url' => route('smsApi.update',@$api_detail->id), 'files' => true, 'class' => 'form-horizontal']) }}
                    @method('put')
                @else
                {{ Form::open(['url' => route('smsApi.store'), 'files' => true, 'class' => 'form-horizontal']) }}
                @endif
                <div class="col-12">
                    <div class="card-body">
                        @csrf
                        <div class="form-group row" style="align-items: center;">
                            <label class="col-md-4" style="margin-bottom:0;">Active SMS API</label>
                            <div class="btn-group btn-group-toggle col-md-3" data-toggle="buttons">
                                <label class="btn btn-default active">
                                    <input type="radio" name="status" autocomplete="off" value="1" {{ (@$api_detail->status==1 || old('status'))?'checked':'' }}> Yes
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="status" autocomplete="off" value="0" {{ (@$api_detail->status==0)?'checked':'' }}> No
                                </label>
                            </div>
                        </div>

                        <div id="metatag-details">
                            <div class="form-group row">
                              {{Form::label('api','SMS API URL',['class'=>'col-sm-4 col-form-label'])}}
                                <div class="col-sm-6">
                                    {{Form::text('api',@$api_detail->api,['class'=>'form-control','id'=>'api','placeholder'=>'SMS API URL','required'=>false])}}
                                    @error('api')
                                    <span class="help-block error">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                {{Form::label('token','SMS API Token',['class'=>'col-sm-4 col-form-label'])}}
                                <div class="col-sm-6">
                                    {{Form::text('token',@$api_detail->token,['class'=>'form-control','id'=>'token','placeholder'=>'SMS Token','required'=>false])}}
                                    @error('token')
                                    <span class="help-block error">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                              {{Form::label('identity','SMS Identity',['class'=>'col-sm-4 col-form-label'])}}
                                <div class="col-sm-6">
                                    {{Form::text('identity',@$api_detail->identity,['class'=>'form-control','id'=>'identity','placeholder'=>'SMS API Identity','required'=>false])}}
                                    @error('identity')
                                    <span class="help-block error">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(@$api_detail && @$api_detail->status==1)
                    <div class="px-4">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">SMS API Info</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr align="center">
                                    <th style="width: 10px">#</th>
                                    <th>Web SMS API</th>
                                    <th>API Token</th>
                                    <th>Identity</th>
                                    <th>Balance</th>
                                    <th>Consumed</th>
                                    <th>API Updated</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr align="center">
                                    <td>1.</td>
                                    <td>{{ @$api_detail->api }}</td>
                                    <td><span class="badge bg-success">{{ @$api_detail->token }}</span></td>
                                    <td>{{ @strtoupper($api_detail->identity) }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            Rs.{{ @number_format(getsmsbalance($api_detail->token),2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">
                                        Rs.{{@number_format(getsmsbalance($api_detail->token,'con'),2)}}
                                        </span>
                                    </td>
                                    <td>{{ @$api_detail->updated_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                @endif
                <div class="card-footer">
                    {{Form::button("<i class='fa fa-paper-plane'></i> Save Setting",['class'=>'global-btn','type'=>'submit'])}}
                    <a href="{{ route('dashboard.index') }}" class="global-btn float-right"><i class="fa fa-list"></i> Dashboard</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection
