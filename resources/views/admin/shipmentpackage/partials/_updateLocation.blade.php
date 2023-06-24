<!-- Button trigger modal -->
<button type="button" class="global-btn" data-toggle="modal" data-target="#modelId">
  {{  $value->getStatusLevel->title }}
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['method'=>'get']) !!}
            <div class="modal-header">
                <h5 class="modal-title">{{ $value->awb_number }} Location Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="form-group">
                    {!! Form::label('country', 'Country') !!}
                    <input type="text" name="country" id="" class="form-control form-control-sm" placeholder="">
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    <input type="text" name="status" id="" class="form-control form-control-sm" placeholder="">
                </div>
                <div class="form-group">
                    {!! Form::label('location', 'Location') !!}
                    <input type="text" name="location" id="" class="form-control form-control-sm" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="global-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="global-btn">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
