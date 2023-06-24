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

                var type = $('#type option:selected').val();
                console.log(type);
                if (type == 'zone') {
                    $("#zone").show();
                } else {
                    $("#zone").hide();
                }
            })
            $('#type').on('ready change', function(e) {
                var type = $(this).val();
                console.log(type);
                if (type == 'zone') {
                    $("#zone").show();
                } else {
                    $("#zone").hide();
                }
            });
            $('#serviceagent_id').on('change ready', function() {
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('zonal.getCountries') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        serviceAgentId: id,
                        countryId: {{ $zonalData_info['requestCountryId'] }}
                    },
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response.length;
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = response[i].id;
                                    var name = response[i].name;
                                    var selected = response[i].selected;
                                    var option = `"<option value='${id}'${selected} >${name}</option>"`;
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
                    {{ Form::open(['url' => route('zonal.bulkupdate'), 'files' => true, 'class' => 'form', 'name' => 'zonal_form']) }}
                    <label for="id of input"></label>
                    <div class="row">
                        <input type="hidden" name="zone_id" value="{{ $zonalData_info['zone_id'] }}">
                        <input type="hidden" name="serviceagent_id" value="{{ $zonalData_info['serviceagent_id'] }}">

                        <div class="col-sm-10 offset-lg-1">
                            @livewire('selectedcountry',$zonalData_info)
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('', '', ['class' => 'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['class' => 'btn btn-success btn-flat', 'type' => 'submit']) }}
                            {{ Form::button("<i class='fas fa-sync-alt'></i> Reset", ['class' => 'btn btn-danger btn-flat', 'type' => 'reset']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@endsection
