<div class="div">
    <button type="button" class="btn btn-dark btn-sm " data-toggle="modal" data-target="#modelId">
        add Customer
    </button>


    <div wire:ignore.self class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent="customerSave">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group row">
                                {{ Form::label('customerName', 'Name.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                {!! Form::text('customerName', '', ['class' => 'form-control form-control-sm col-md-8', 'wire:model' => 'customerName']) !!}
                                @error('customerName') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror

                            </div>
                            <div class="form-group row">
                                {{ Form::label('customerMobile', 'Mobile.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                {!! Form::number('customerMobile', '', ['class' => 'form-control form-control-sm col-md-8', 'wire:model' => 'customerMobile']) !!}
                                @error('customerMobile') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror
                            </div>
                            <div class="form-group row">
                                {{ Form::label('customerEmail', 'Email.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                {!! Form::email('customerEmail', '', ['class' => 'form-control form-control-sm col-md-8', 'wire:model' => 'customerEmail']) !!}
                                @error('customerEmail') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror

                            </div>
                            <div class="form-group row">
                                {{ Form::label('customerAddress', 'Address.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                {!! Form::text('customerAddress', '', ['class' => 'form-control form-control-sm col-md-8', 'wire:model' => 'customerAddress']) !!}
                                @error('customerAddress') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror

                            </div>
                            <div class="form-group row">
                                {{ Form::label('customerState', 'State.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                {!! Form::text('customerState', '', ['class' => 'form-control form-control-sm col-md-8', 'wire:model' => 'customerState']) !!}
                                @error('customerState') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror

                            </div>
                            <div class="form-group row">
                                {{ Form::label('customerZipCode', 'ZipCode.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                {!! Form::text('customerZipCode', '', ['class' => 'form-control form-control-sm col-md-8', 'wire:model' => 'customerZipcode']) !!}
                                @error('customerZipCode') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror

                            </div>
                            <div class="form-group row">
                                {{ Form::label('customerCity', 'city.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                {!! Form::text('customerCity', '', ['class' => 'form-control form-control-sm col-md-8', 'wire:model' => 'customerCity']) !!}
                                @error('customerCity') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror

                            </div>
                            <div class="form-group row">
                                {{ Form::label('customerCountry', 'Country.:*', ['class' => 'col-md-3 text-capitalize form-control-sm']) }}
                                <select class="form-control form-control-sm col-md-8" name="customerCountry"
                                    wire:model='customerCountry'>
                                    <option></option>
                                    @foreach ($countries as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('customerCountry') <span
                                    class="help-block error"><small>{{ $message }}</small></span> @enderror

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

    </script>
</div>
@push('scripts')
    <script>
        window.addEventListener('customerCreated', event => {
            console.log('customerCraeted')
            $('#modelId').modal('hide')
        })
    </script>
@endpush
