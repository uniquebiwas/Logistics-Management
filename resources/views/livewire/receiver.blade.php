<div class="col-6 ">
    <h5 class="text-capitalize">{{ $type }} Information</h5>
    <hr>

    <div class="form-group row">
        {{ Form::label($type . 'Company', 'Consignee*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Company', $receiver_info->receiverCompany, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row @error('receiverAttention') has-error @enderror">
        {{ Form::label('receiverAttention', 'attention*', ['class' => 'col-md-4 form-control-sm']) }}
        {{ Form::text('receiverAttention', $attention ?? old('receiverAttention'), ['class' => 'form-control form-control-sm col-md-6', 'id' => 'attention', 'placeholder' => 'Contact Person', 'required' => true, 'style' => 'width:80%']) }}
        @error('receiverAttention')
            <span class="help-block error"><small>{{ $message }}</small></span>
        @enderror

    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Address', ' Address *', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Address', $receiver_info->receiverAddress, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Address2', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Address2', $receiver_info->receiverAddress2, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Address3', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Address3', $receiver_info->receiverAddress3, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'City', ' city*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'City', $receiver_info->receiverCity, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'ZipCode', ' Zip Code', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'ZipCode', $receiver_info->receiverZipCode, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'State', ' State*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'State', $receiver_info->receiverState, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Country', ' Country*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        <!-- {!! Form::text($type . 'Country', optional($reciever->getCountry)->name, ['class' => 'form-control form-control-sm col-md-8']) !!} -->
        <!-- {{ Form::select($type . 'Country', @$countries, null, ['class' => 'form-control form-control-sm col-md-6', 'id' => 'country', 'placeholder' => 'Select receiver country', 'required' => true, 'style' => 'width:80%']) }} -->
        <select name="receiverCountry" class="form-control form-control-sm col-md-6"
            placeholder="Select receiver Country">
            <option disabled>--Select Receiver Country--</option>
            @foreach ($countries as $country)
                <option value="{{ $country->name }}" @if ($country->name == $receiver_info->receiverCountry) {{ 'Selected ' }} @endif>{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group row">
        {{ Form::label($type . ' Telephone', ' Telephone*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Telephone', $receiver_info->receiverTelephone, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . ' Mobile', ' Mobile', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::number($type . 'Mobile', $receiver_info->receiverMobile, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Email', ' Email*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::email($type . 'Email', $receiver_info->receiverEmail, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>


</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#receiverId").select2();
            $("#receiverId").on('change', function(e) {
                @this.set('receiverId', e.target.value);
            });
        })
        document.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('#receiverId').select2()

            });
        });
    </script>
@endpush
