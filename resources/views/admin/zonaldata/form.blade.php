@extends('layouts.admin')
@section('title', $title)
    @push('scripts')
        {{-- <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
        <script src="{{ asset('/custom/zonal.js') }}"></script> --}}

        <script>
            $(document).ready(function() {
                $("#zone").hide();
                $(".select2").select2({
                    placeholder: 'Select Countries',
                });
            })
            $('#type').change(function() {
                var type = $(this).val();
                console.log(type);
                if (type == 'zone') {
                    $("#zone").show();
                } else {
                    $("#zone").hide();
                }
            });
            $('#serviceagent_id').change(function() {
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('zonal.getCountries') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        serviceAgentId: id,

                    },
                    success: function(response) {
                        $("#country_id").empty();
                        var len = 0;
                        if (response != null) {
                            len = response.length;
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = response[i].id;
                                    var name = response[i].name;
                                    var option = "<option value='" + id + "'>" + name + "</option>";
                                    $("#country_id").append(option);
                                }
                            }
                        } else {
                            alert('Error while fetching data');
                        }
                    }
                });
            });

        </script>
    @endpush
@section('content')
    @include('admin.shared.image_upload')
    <section class="content-header pt-0"></section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ @$title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('zonal.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">
                    @if (isset($zonal_info))
                        {{ Form::open(['url' => route('zonal.update', $zonal_info->id), 'files' => true, 'class' => 'form', 'name' => 'zonal_form']) }}
                        @method('put')
                    @else
                        {{ Form::open(['url' => route('zonal.store'), 'files' => true, 'class' => 'form', 'name' => 'zonal_form']) }}
                    @endif
                    <label for="id of input"></label>
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group row {{ $errors->has('type') ? 'has-error' : '' }}">
                                {{ Form::label('type', 'Zone or Country*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('type', ['country' => 'Country', 'zone' => 'Zone'], @$zonal_info->type, ['class' => 'form-control', 'id' => 'type', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('type')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div id="zone">
                                <div class="form-group row {{ $errors->has('zone_id') ? 'has-error' : '' }}">
                                    {{ Form::label('zone_id', 'Zone *', ['class' => 'col-sm-2']) }}
                                    <div class="col-sm-10">
                                        {{ Form::select('zone_id', @$zones, @$zonal_info->zone_id, ['class' => 'form-control', 'id' => 'zone_id', 'style' => 'width:80%']) }}
                                        @error('zone_id')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('serviceagent_id') ? 'has-error' : '' }}">
                                {{ Form::label('serviceagent_id', 'Service Agent *', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('serviceagent_id', @$serviceAgents, @$zonal_info->serviceagent_id, ['class' => 'form-control', 'placeholder' => 'Select Service Agent', 'id' => 'serviceagent_id', 'style' => 'width:80%']) }}
                                    @error('serviceagent_id')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('country_id') has-error @enderror">
                                {{ Form::label('country_id', 'Countries :*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('country_id[]', [], @$shipmentInfo->country_id, ['class' => 'form-control select2', 'multiple' => true, 'id' => 'country_id', 'placeholder' => 'Select Countries', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('country_id')
                                        <span class="help-block error"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('publishStatus') ? 'has-error' : '' }}">
                                {{ Form::label('publishStatus', 'Publish Status*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('publishStatus', [true => 'Yes', false => 'No'], @$zonal_info->publishStatus, ['class' => 'form-control', 'id' => 'publishStatus', 'required' => true, 'style' => 'width:80%']) }}
                                    @error('publishStatus')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-2']) }}
                        <div class="col-sm-10">
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'global-btn', 'type' => 'submit']) }}
                            {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'global-btn', 'type' => 'reset']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
