<div class="col-6 ">
    <h5 class="text-capitalize">Receiver Information</h5>
    <hr>

    <div class="form-group row">
        {{ Form::label('receiverCompany', 'Consignee*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverCompany', $shipmentPackage_info->receiverCompany, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>

    <div class="form-group row">
        {{ Form::label('receiverAddress', ' Address *', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverAddress', $shipmentPackage_info->receiverAddress, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('receiverAddress2', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverAddress2', $shipmentPackage_info->receiverAddress2, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('receiverAddress3', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverAddress3', $shipmentPackage_info->receiverAddress3, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('receiverCity', ' city*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverCity', $shipmentPackage_info->receiverCity, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('receiverZipCode', ' Zip Code', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverZipCode', $shipmentPackage_info->receiverZipCode, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('receiverState', ' State', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverState', $shipmentPackage_info->receiverState, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>

    <div class="form-group row">
        {{ Form::label('receiverCountryId', ' Country*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::select('receiverCountryId', $countries, $shipmentPackage_info->receiverCountryId, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Receiver Country', 'required', 'id' => 'receiverCountryId']) !!}
    </div>
    <div class="form-group row d-none">
        {{ Form::label('receiverCountry', ' Country*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverCountry', $shipmentPackage_info->receiverCountry, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Receiver Country', 'required']) !!}
    </div>


    <div class="form-group row">
        {{ Form::label('receiver Telephone', ' Telephone', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('receiverTelephone', $shipmentPackage_info->receiverTelephone, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('receiver Mobile', ' Mobile', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::number('receiverMobile', $shipmentPackage_info->receiverMobile, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>

    <div class="form-group row">
        {{ Form::label('receiverEmail', ' Email', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::email('receiverEmail', $shipmentPackage_info->receiverEmail, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row @error('receiverAttention') has-error @enderror">
        {{ Form::label('receiverAttention', 'Attention *', ['class' => 'col-md-4 form-control-sm']) }}
        {{ Form::text('receiverAttention', $shipmentPackage_info->receiverAttention, ['class' => 'form-control form-control-sm col-md-6', 'id' => 'attention', 'placeholder' => 'Receiver Contact Person', 'required' => true, 'style' => 'width:80%']) }}
        @error('receiverAttention')
            <span class="help-block error"><small>{{ $message }}</small></span>
        @enderror
    </div>
</div>

@push('scripts')
    <script>
        $('#receiverCountryId').on('change', function() {
            $('#receiverCountry').val($('#receiverCountryId option:selected').html());
        })
    </script>
@endpush
