<!-- Button trigger modal -->
<button type="button" class="view-btn" data-toggle="modal" data-target="#modelId{{ $value->id }}">
    <i class="fas fa-envelope"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modelId{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $value->agent_profile->company_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => route('changeEmail', $value->id)]) !!}
            @csrf
            <div class="modal-body">
                <div class="container-fluid">
                    {!! Form::email('email', $value->email, ['class' => 'form-control form-control-sm']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="view-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="view-btn">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
    });
</script>
