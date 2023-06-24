<!-- Button trigger modal -->
<button type="button" class="view-btn" data-toggle="modal" data-target="#modalView{{ $credit->id }}">
    {{ $credit->dueDate->format('d-M-y') }}
</button>

<!-- Modal -->
<div class="modal fade" id="modalView{{ $credit->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $credit->agentCompany }} title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => route('credit-dueDate-change'), 'class' => 'updateAgentDueDate']) !!}
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group text-left">
                        <label for="">Due Date</label>
                        {!! Form::hidden('id', $credit->id) !!}
                        <input type="date" name="dueDate" id="" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $credit->dueDate->toDateString() }}">
                        <small id="helpId" class="text-muted">Change Due Date</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submit">Save</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

<script>

</script>
