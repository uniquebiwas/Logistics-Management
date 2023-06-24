@extends('layouts.admin')
@section('title', $title)
@push('scripts')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/pricing.js') }}"></script>
    <script>
        var buttonCounter = 0;
        $(document).ready(function() {
            $(".select2").select2();

            $(document).off('click', '#add').on('click', '#add', function(e) {
                buttonCounter++;
                var part =
                    '<tr><td><input name="weight[]" type="text" placeholder="Weight" class="form-control weight"></td><td><input name="price[]" placeholder="Price" type="text" class="form-control price"></td><td><button type="button" class="btn btn-flat btn-outline-danger btn_remove"><i class="fas fa-trash"></i></button></td></tr>';
                $('#tablebody').append(part);
            });
            $(document).on('click', '.btn_remove', function() {
                $(this).closest('tr').remove();
            });
        });
        $("form[name='pricing_form']").submit(function(event) {
            var valueList = [];
            var weightfrominputs = $(".weightfrom");
            var weighttoinputs = $(".weightto");
            for (var i = 0; i < weightfrominputs.length; i++) {
                valueList.push({
                    fromValue: $(weightfrominputs[i]).val(),
                    toValue: $(weighttoinputs[i]).val(),
                });
            }

            valueList.forEach(element => {
                if (parseFloat(element.fromValue) >= parseFloat(element.toValue)) {
                    event.preventDefault();
                    alert('Inappropriate Range Format: Weight From ' + parseFloat(element.fromValue) +
                        ' & Weight To ' +
                        parseFloat(element.toValue));
                    return;
                } else {
                    return;
                }
            });
            valueList = [];
        });
        $('#serviceAgentId').change(function() {
            $("#region").empty();
            $("#zoneOrCountry").val('');
        });
        $('#zoneOrCountry').change(function() {
            var val = $(this).val();
            var id = $('#serviceAgentId').val();
            $.ajax({
                url: "{{ route('pricing.getCountriesAndZone') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    serviceAgentId: id,
                    zoneOrCountry: $('#zoneOrCountry').val()
                },
                success: function(response) {
                    console.log(response);
                    $("#region").empty();
                    var region_length = 0;
                    if (response != null) {
                        region_length = response.length;
                        if (region_length > 0) {
                            for (var i = 0; i < region_length; i++) {
                                var id = response[i].id;
                                var name = response[i].title;
                                var
                                    option = "<option value='" + id + "'>" + name + "</option>";
                                $("#region").append(option);
                            }
                        } else {
                            alert('No regions found in selected service agent');
                        }
                    } else {
                        alert('No data fetched ');
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
                        <a href="{{ route('pricing.index') }}" type="button" class="btn btn-tool">
                            <i class="fa fa-list"></i></a>
                    </div>
                </div>
                @include('admin.shared.error-messages')
                <div class="card-body">

                    {{ Form::open(['url' => route('pricing.excel'), 'files' => true, 'class' => 'form', 'name' => 'pricing_form']) }}
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group row {{ $errors->has('agent_id') ? 'has-error' : '' }}">
                                {{ Form::label('agent_id', 'Local Agent*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('agent_id[]', @$users, @$pricing_info->agent_id, ['class' => 'form-control select2', 'multiple' => true, 'id' => 'agent_id', 'style' => 'width:80%', 'disabled' => isset($pricing_info) ? true : false]) }}
                                    @error('agent_id')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('serviceAgentId') ? 'has-error' : '' }}">
                                {{ Form::label('serviceAgentId', 'Service Agent*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('serviceAgentId', @$serviceAgents, @$pricing_info->serviceAgentId, ['class' => 'form-control', 'id' => 'serviceAgentId', 'placeholder' => 'Select Service Agent', 'style' => 'width:80%', 'disabled' => isset($pricing_info) ? true : false]) }}
                                    @error('serviceAgentId')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('publishStatus') ? 'has-error' : '' }}">
                                {{ Form::label('publishStatus', 'Publish Status*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {{ Form::select('publishStatus', [true => 'Yes', false => 'No'], @$pricing_info->publishStatus, ['class' => 'form-control', 'id' => 'publishStatus', 'style' => 'width:80%']) }}
                                    @error('publishStatus')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('effectiveDate') ? 'has-error' : '' }}">
                                {{ Form::label('effectiveDate', 'Effective Date*', ['class' => 'col-sm-2']) }}
                                <div class="col-sm-10">
                                    {!! Form::date('effectiveDate', now(), ['class' => 'form-control', 'id' => 'effectiveDate', 'style' => 'width:80%', 'required' => 'true']) !!}

                                    @error('effectiveDate')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="pricing " class="col-sm-2">Pricing Excel</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control-file" name="excelFile" id="pricing"
                                        placeholder="Import Your Pricing Here" aria-describedby="fileHelpId"
                                        style="width: 80%;">
                                    @error('excelFile')
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
