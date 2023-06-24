<!-- Button trigger modal -->
<button type="button" class="global-btn" data-toggle="modal" data-target="#createManifest">
    Create National manifest<i class="fas fa-save" style="margin-left:7px;"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="createManifest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{ Form::open(['method' => 'POST', 'route' => ['national-manifest.store'], 'style' => 'display:inline', 'onsubmit' => 'return confirm("Are you sure you want to create new National Manifest")']) }}
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Consignee </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row text-capitalize">
                        <div class="form-group col-12">
                            <label for="client">Name </label>
                            <input type="text" name="client" id="client" class="form-control form-control-sm"
                                placeholder="Name" aria-describedby="clientId">
                            @error('client')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="clientLocation">Address</label>
                            <input type="text" name="clientLocation" id="clientLocation"
                                class="form-control form-control-sm" placeholder="location"
                                aria-describedby="clientLocationId">
                            @error('clientLocation')
                                <small id="clientLocationId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control form-control-sm" placeholder="phone"
                                aria-describedby="phoneId">
                            @error('phone')
                                <small id="phoneId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="remarks">Remarks</label>
                            <input type="text" name="remarks" id="remarks"
                                class="form-control form-control-sm" placeholder="remarks"
                                aria-describedby="remarksId">
                            @error('remarks')
                                <small id="remarksId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="global-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="global-btn">Save</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
