<div class="col-6 ">
    <h5 class="text-capitalize">{{ $type }} Information</h5>
    <hr>
    <div class="form-group row">
        {{ Form::label('shipment_date', 'Date*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        <input type="text" name="shipment_date" id="shipment_date" class="form-control form-control-sm col-md-6" value="{{date('Y-m-d h:i:s')}}" >
    </div>
    <div class="form-group row">
        {{ Form::label('account_number', 'Agent Code*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        <input type="text" name="account_number" id="account_number" class="form-control form-control-sm col-md-6" value="{{ @\Auth::user()->accountNumber }}" >

    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Name', 'Shipper*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        <input type="text" name="{{$type . 'Name'}}" id="Name" class="form-control form-control-sm col-md-6" value="{{ @\Auth::user()->name['en'] }}" >

    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Attention', ' Attention*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Attention', $sender_info->senderAttention, ['class' => 'form-control form-control-sm col-md-6', 'placeholder' => 'Contact Person']) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Address', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Address', $sender_info->senderAddress, ['class' => 'form-control form-control-sm col-md-6', ]) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Address2', ' Address', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'Address2', $sender_info->senderAddress2, ['class' => 'form-control form-control-sm col-md-6', ]) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'City', ' city*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'City', $sender_info->senderCity, ['class' => 'form-control form-control-sm col-md-6', ]) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'ZipCode', ' Zip Code', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'ZipCode', $sender_info->senderZipCode, ['class' => 'form-control form-control-sm col-md-6', ]) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'State', ' State', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text($type . 'State', $sender_info->senderState, ['class' => 'form-control form-control-sm col-md-6', ]) !!}
    </div>
    <div class="form-group row">

        {{ Form::label('senderCountry', ' Country', ['class' => 'col-md-4 text-capitalize form-control-sm', 'style' => 'text-align: left;']) }}
        {!! Form::text('senderCountry', 'Nepal', ['class' => 'form-control form-control-sm col-md-6', 'value' => 'Nepal', 'disabled' => true,]) !!}


    </div>

    <div class="form-group row">
        {{ Form::label($type . 'Mobile',  ' Tel/Mobile*', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::number($type . 'Mobile', $sender_info->senderMobile, ['class' => 'form-control form-control-sm col-md-6', ]) !!}
    </div>
    <div class="form-group row">
        {{ Form::label($type . 'Email', ' Email', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::email($type . 'Email', $sender_info->senderEmail, ['class' => 'form-control form-control-sm col-md-6', ]) !!}
    </div>


    <div class="form-group row">
        {{ Form::label('reference_number', ' Reference Number', ['class' => 'col-md-4 text-capitalize form-control-sm']) }}
        {!! Form::text('reference_number', $reference_number, ['class' => 'form-control form-control-sm col-md-6', 'disabled' => false,'wire:model'=>'reference_number']) !!}
    </div>


</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#senderId").select2();
            $("#senderId").on('change', function(e) {
                @this.set('customerId', e.target.value);
            });
        })
        document.addEventListener("livewire:load", () => {
            Livewire.hook('message.processed', (message, component) => {
                $('#senderId').select2()

            });
        });
    </script>
@endpush
