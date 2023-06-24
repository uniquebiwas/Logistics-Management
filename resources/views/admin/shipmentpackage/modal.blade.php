<!-- Button trigger modal -->
<button type="button" class="view-btn ml-1" data-toggle="modal" data-target="#{{ 'modal' . $value->id }}"
    title="schedule">
    <i class="far fa-clock"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="{{ 'modal' . $value->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{ Form::open(['url' => route('shipmentpackage.schedule', @$value->id), 'class' => 'form', 'name' => 'shipment_schedule_form']) }}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $value->barcode }} Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="form-group col-12 text-left">
                            {{ Form::label('scheduled_for', 'Schedule For :*') }}
                            {{ Form::date('scheduled_for', @$value->scheduled_for, ['id' => 'scheduled_for', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                            @error('scheduled_for')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12 text-left">
                            {{ Form::label('flightNumber', 'Flight Number :*') }}
                            {{ Form::text('flightNumber', @$value->flightNumber, ['id' => 'flightNumber', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                        </div>
                        <div class="form-group col-12 text-left">
                            {{ Form::label('airlines', 'Airline :*') }}
                            {{ Form::text('airlines', @$value->airlines, ['id' => 'airlines', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="global-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="global-btn" id="save">Save</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
