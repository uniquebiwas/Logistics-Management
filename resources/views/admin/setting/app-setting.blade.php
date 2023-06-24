@extends('layouts.admin')
@section('title', 'Basic Site Settings')
@push('styles')
    <style>
        .btn-default.active,
        .btn-default.active:hover {
            background-color: #17a2b8;
            border-color: #138192;
            color: #fff;
        }

    </style>
@endpush
@push('scripts')
    <script type="text/javascript" src="{{ asset('/custom/jqueryvalidate.js') }}"></script>
    <script src="{{ asset('/custom/appsetting.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $(document).ready(function() {
            // $('#lfm').change(function() {
            //     $('#thumbnail').removeClass('d-none');
            // })
            $('#favicon').change(function() {
                $('#favicon_image').removeClass('d-none');
            })
            $('#og_image').change(function() {
                $('#og_image_preview').removeClass('d-none');

            })
        });

        $('#lfm').filemanager('image');
        $('#footer_path_button').filemanager('image');
        $('#favicon_button').filemanager('image');
        $('#og_image_button').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
            $('#filepath_app_button').filemanager('image');


            $('#filepath_app').change(function() {
                // alert('hello');
                var input = this;
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#filepath_app_view').attr('src', e.target.result).fadeIn(1000);
                        $('#filepath_app_view').removeClass('d-none');
                        // $('#img_edit').addClass('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })
        })
    </script>
    <script>
        UpdateMeta("{{ @$site_detail->is_meta == 1 ? 'YES' : 'NO' }}");
        UpdateFavOg("{{ @$site_detail->is_favicon == 1 ? 'YES' : 'NO' }}");
        UpdateStartAd("{{ @$site_detail->is_startup_ad == 1 ? 'YES' : 'NO' }}");
    </script>
@endpush
@section('content')


    @if (@$site_detail)
        {{ Form::open(['url' => route('setting.update', @$site_detail->id), 'files' => true, 'class' => 'form-horizontal', 'name' => 'appsetting_form']) }}
        @method('put')
    @else
        {{ Form::open(['url' => route('setting.store'), 'files' => true, 'class' => 'form-horizontal', 'name' => 'appsetting_form']) }}
    @endif
    <div class="card-body">
        @csrf
        <div class="card card-tabs">
            <div class="card-header pb-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                            href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                            aria-selected="true">Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                            href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                            aria-selected="false">URLs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                            href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                            aria-selected="false">Web</a>
                    </li>


                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                        aria-labelledby="custom-tabs-three-home-tab">
                        <div class="form-group row">
                            {{ Form::label('name', 'Office Name*', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('name', @$site_detail->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Office Name', 'required' => false]) }}
                                @error('name')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('address', 'Office Address*', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('address', @$site_detail->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Office Address', 'required' => false]) }}
                                @error('address')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('footer_description', 'Footer Discription*', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('footer_description', @$site_detail->footer_description, ['class' => 'form-control', 'id' => 'footer_description', 'placeholder' => 'Office footer_description', 'required' => false]) }}
                                @error('footer_description')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('front_counter_description', 'Homepage Service Title*', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('front_counter_description', @$site_detail->front_counter_description, ['class' => 'form-control', 'id' => 'front_counter_description', 'placeholder' => 'Homepage Service Title', 'required' => false]) }}
                                @error('front_counter_description')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('email', 'Oficial Email*', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('email', @$site_detail->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Oficial Email', 'required' => false]) }}
                                @error('email')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('registration_date', 'Registration Date', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::date('registration_date', @$site_detail->registration_date, ['class' => 'form-control', 'id' => 'registration_date', 'placeholder' => 'registration date', 'required' => false]) }}
                                @error('registration_date')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('registration_number', 'Registration Number', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('registration_number', @$site_detail->registration_number, ['class' => 'form-control', 'id' => 'registration_number', 'placeholder' => 'registration number', 'required' => false]) }}
                                @error('registration_number')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('pan', 'VAT/PAN Number', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::text('pan', @$site_detail->pan, ['class' => 'form-control', 'id' => 'pan', 'placeholder' => 'VAT/PAN Number', 'required' => false]) }}
                                @error('pan')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('phone_number', 'Primary Phone Number*', ['class' => 'col-sm-4 col-form-label', 'required' => false]) }}
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        {{-- {{ dd($site_detail) }} --}}
                                        {{ Form::text('contact_no[0][phone_number]', @$site_detail->phone[0]['phone_number'], ['class' => 'form-control', 'maxlength' => 10, 'id' => 'phone', 'placeholder' => 'Primary Phone Number ']) }}
                                        @error('phone')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="col-lg-6">
                                        {!! Form::text('contact_no[0][contact_city]', @$site_detail->phone[0]['contact_city'], ['class' => 'form-control', 'placeholder' => 'Contact City name ']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('phone_number_one', 'Phone Number One (Optional)', ['class' => 'col-sm-4 col-form-label', 'required' => false]) }}
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        {{ Form::text('contact_no[1][phone_number]', @$site_detail->phone[1]['phone_number'], ['class' => 'form-control', 'maxlength' => 10, 'id' => 'phone', 'placeholder' => 'Phone Number One']) }}
                                        @error('phone')
                                            <span class="help-block error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        {!! Form::text('contact_no[1][contact_city]', @$site_detail->phone[1]['contact_city'], ['class' => 'form-control', 'placeholder' => 'Contact City name ']) !!}

                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group row">
                                    {{ Form::label('filepath_app', 'Official Logo:', ['class' => 'col-sm-4 col-form-label']) }}
                                    <div class="col-lg-6">
                                        <span class="input-group-btn">
                                            <a id="filepath_app_button" data-input="thumbnail"
                                                data-preview="filepath_app_holder" class="global-btn">
                                                Upload Logo
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="hidden" name="logo_url"
                                            value="{{ @$site_detail->logo_url }}">

                                    </div>
                                    <div class="col-lg-4 offset-lg-4">
                                        <div id="filepath_app_holder" style="margin-top:15px;max-width: 100%;">
                                            <img src="{{ @$site_detail->logo_url }}" alt="" style="max-width: 40%">
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group row">
                                    {{ Form::label('footer_path', 'Footer Logo:', ['class' => 'col-sm-4 col-form-label']) }}
                                    <div class="col-lg-6">
                                        <span class="input-group-btn">
                                            <a id="footer_path_button" data-input="footer_thumbnail"
                                                data-preview="footer_path_holder" class="global-btn">
                                                Footer Logo
                                            </a>
                                        </span>
                                        <input id="footer_thumbnail" class="form-control" type="hidden" name="logo"
                                            value="{{ @$site_detail->logo }}">

                                    </div>
                                    <div class="col-lg-4 offset-lg-4">
                                        <div id="footer_path_holder" style="margin-top:15px;max-width: 100%;">
                                            <img src="{{ @$site_detail->logo }}" alt="" style="max-width: 40%">
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group row">

                                    {{ Form::label('favicon', 'Image for App (optional):', ['class' => 'col-sm-4 col-form-label']) }}
                                    <div class="col-lg-6">
                                        <span class="input-group-btn">
                                            <a id="favicon_button" data-input="favicon_image" data-preview="favicon_holder"
                                                class="global-btn">
                                                Fab icon (icon on browser tab)
                                            </a>
                                        </span>
                                        <input id="favicon_image" class="form-control" type="hidden" name="favicon"
                                            value="{{ @$site_detail->favicon }}">

                                    </div>
                                    <div class="col-lg-4 offset-lg-4">
                                        <div id="favicon_holder" style="margin-top:15px;max-width: 100%;">
                                            <img src="{{ @$site_detail->favicon }}" alt="" style="max-width: 40%">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <div class="input-group row">
                                    {{ Form::label('og_image', 'OG Image:', ['class' => 'col-sm-4 col-form-label']) }}
                                    <div class="col-lg-6">
                                        <span class="input-group-btn">
                                            <a id="og_image_button" data-input="og_image_preview"
                                                data-preview="og_image_holder" class="global-btn">
                                                Upload og image
                                            </a>
                                        </span>
                                        <input id="og_image_preview" class="form-control" type="hidden" name="og_image"
                                            value="{{ @$site_detail->og_image }}">

                                    </div>
                                    <div class="col-lg-4 offset-lg-4">
                                        <div id="og_image_holder" style="margin-top:15px;max-width: 100%;">
                                            <img src="{{ @$site_detail->og_image }}" alt="" style="max-width: 40%">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>



                    </div>

                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-three-profile-tab">

                        <div class="form-group row">
                            {{ Form::label('term_con_link', '  Term and Condition Link*', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::url('term_con_link', @$site_detail->term_con_link, ['class' => 'form-control', 'id' => 'term_con_link', 'placeholder' => 'Term and condition link', 'required' => false]) }}
                                @error('term_con_link')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                                                        {{ Form::label('app_url', '  App URL*', ['class' => 'col-sm-4 col-form-label']) }}
                                                        <div class="col-sm-6">
                                                            {{ Form::url('app_url', @$site_detail->app_url, ['class' => 'form-control', 'id' => 'app_url', 'placeholder' => 'Android App URL', 'required' => false]) }}
                                                            @error('app_url')
                                                                                            <span class="help-block error">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div> -->


                        <div class="form-group row">
                            {{ Form::label('twitter', 'Official Twitter', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::url('twitter', @$site_detail->twitter, ['class' => 'form-control', 'id' => 'twitter', 'placeholder' => 'Official Twitter(Eg.https://twitter.com/shrivahan)', 'required' => false]) }}
                                @error('twitter')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('facebook', 'Official Facebook', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::url('facebook', @$site_detail->facebook, ['class' => 'form-control', 'id' => 'facebook', 'placeholder' => 'Official Facebook (Eg.https://facebook.com/shrivahan)', 'required' => false]) }}
                                @error('facebook')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('youtube', 'Official Youtube', ['class' => 'col-sm-4 col-form-label']) }}
                            <div class="col-sm-6">
                                {{ Form::url('youtube', @$site_detail->youtube, ['class' => 'form-control', 'id' => 'youtube', 'placeholder' => 'Official Youtue (Eg.https://youtube.com/channel_url)', 'required' => false]) }}
                                @error('youtube')
                                    <span class="help-block error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">


                        <div class="page-description-div">
                            <div class="form-group row">
                                {{ Form::label('min_agent_balance', 'Minimum Agent Balance', ['class' => 'col-sm-4 col-form-label']) }}
                                <div class="col-sm-6">
                                    {{ Form::number('min_agent_balance', @$site_detail->min_agent_balance, ['class' => 'form-control', 'id' => 'min_agent_balance', 'placeholder' => 'Minimum Amount in Agent Wallet', 'required' => false]) }}
                                    @error('min_agent_balance')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('tiaCharge', 'TIA Charge per kg', ['class' => 'col-sm-4 col-form-label']) }}
                                <div class="col-sm-6">
                                    {{ Form::text('tiaCharge', @$site_detail->tiaCharge, ['class' => 'form-control', 'id' => 'tiaCharge', 'placeholder' => 'TIA CHARGE', 'required' => false]) }}
                                    @error('tiaCharge')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        {{ Form::button("<i class='fa fa-paper-plane'></i> Save Settings", ['class' => 'global-btn', 'type' => 'submit']) }}
        <a href="{{ route('dashboard.index') }}" class="global-btn float-right"><i class="fa fa-list"></i>
            Dashboard</a>
    </div>
    {{ Form::close() }}

@endsection
