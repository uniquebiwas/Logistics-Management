{{ Form::button('schedule', ['class' => 'global-btn', 'id' => 'schedule_button', 'data-toggle' => 'modal', 'data-target' => '#scheduleModal']) }}


<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">Schedule
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="bulk_shipmentForm">
                <div class="modal-body col-12">
                    <div class="form-group">
                        {{ Form::label('scheduled_for', 'Schedule For :*') }}
                        {{ Form::date('scheduled_for', '', ['id' => 'bulk_scheduled_for', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                        @error('scheduled_for')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('flightNumber', 'Flight Number :*') }}
                        {{ Form::text('flightNumber', '', ['id' => 'bulk_flightNumber', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('airlines', 'Airline :*') }}
                        {{ Form::text('airlines', '', ['id' => 'bulk_airlines', 'class' => 'form-control form-control-sm', 'required' => 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('mwab', 'Master Airway Bill (MWAB)') }}
                        {{ Form::text('mwab', '', ['id' => 'bulk_mwab', 'class' => 'form-control form-control-sm']) }}
                    </div>

                </div>

                <div class="modal-footer">
                    {{ Form::button(' Submit', ['class' => 'btn btn-success btn-flat', 'type' => 'submit', 'id' => 'schedule_shipment']) }}
                    <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('#bulk_shipmentForm').on('submit', function(e) {
            e.preventDefault();
            var val = [];
            var url = "{{ route('shipmentpackage.bulkSchedule') }}";
            $('.checked:checked').each(function() {
                val.push($(this).val());
            })
            if (val.length == 0) {
                return toastr.error('error!', 'Select At least one AWB to Schedule');
            }

            axios({
                method: 'post',
                url: url,
                data: {
                    'ids': val,
                    'scheduled_for': $('#bulk_scheduled_for').val(),
                    'flightNumber': $('#bulk_flightNumber').val(),
                    'airlines': $('#bulk_airlines').val(),
                    'mwab': $('#bulk_mwab').val(),
                }
            }).then((response) => {
                toastr.success('success!', response.data.message);
                setTimeout(location.reload(), 2000);
            }).catch(function(error) {
                if (error.response) {
                    error.response.data.message.forEach(element => {
                        toastr.error('Error!', element)
                    });
                }
            });

        });
    </script>
@endpush
