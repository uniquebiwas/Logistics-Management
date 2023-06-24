<div class="col-6 ">
    <h5 class="text-capitalize">Sender Information</h5>
    <hr>
    <div class="form-group row">
        {{ Form::label('shipment_date', 'Date*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        <input type="text" name="shipment_date" id="shipment_date" class="form-control form-control-sm col-md-6"
            value="{{ date('Y-m-d h:i:s') }}">
    </div>

    @can('create-awb-as-default-admin')
        <x-account-number-component :agentId='$shipmentPackage_info->agentId' />
    @else
        <div class="form-group row">
            {{ Form::label('account_number', 'Agent Code*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
            <input type="text" name="account_number" id="account_number" class="form-control form-control-sm col-md-6"
                value="{{ @\Auth::user()->load('agent_profile')->company_name }}">
        </div>

    @endcan
    <div class="form-group row">
        {{ Form::label('senderName', ' Shipper*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('senderName', $shipmentPackage_info->senderName, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Shipper']) !!}
    </div>

    <div class="form-group row">
        {{ Form::label('senderAddress', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('senderAddress', $shipmentPackage_info->senderAddress, ['class' => 'form-control form-control-sm col-md-6', 'required' => 'required']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('senderAddress2', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('senderAddress2', $shipmentPackage_info->senderAddress2, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('senderCity', ' city*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('senderCity', $shipmentPackage_info->senderCity, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('senderZipCode', ' Zip Code', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('senderZipCode', $shipmentPackage_info->senderZipCode, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('senderState', ' State', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('senderState', $shipmentPackage_info->senderState, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('senderCountry', ' Country', ['class' => 'col-md-4 text-capitalize form-control-sm', 'style' => 'text-align: left;']) }}
        {!! Form::text('senderCountry', 'Nepal', ['class' => 'form-control form-control-sm col-md-6', 'value' => 'Nepal', 'disabled' => true]) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('senderMobile', ' Tel/Mobile', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::number('senderMobile', $shipmentPackage_info->senderMobile, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>

    <div class="form-group row">
        {{ Form::label('senderEmail', ' Email', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::email('senderEmail', $shipmentPackage_info->senderEmail, ['class' => 'form-control form-control-sm col-md-6']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label('senderAttention', ' Attention *', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('senderAttention', $shipmentPackage_info->senderAttention, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Sender Contact Person']) !!}
    </div>
</div>
