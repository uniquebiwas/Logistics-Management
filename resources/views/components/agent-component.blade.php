<div class="col-lg-1 col-md-1 col-sm-1">
    {!! Form::select('limit', ['20' => 20, '50' => 50, '100' => 100, '200' => 200, '500' => 500], request()->limit, ['class' => 'form-control form-control-sm','placeholder' => 'Limit']) !!}
</div>
<div class="col-lg-2 col-md-2 col-sm-2">
    {!! Form::text('keyword',  request()->keyword, ['class' => 'form-control form-control-sm','placeholder'=>'AWB Number']) !!}
</div>
<div class="col-lg-2 col-md-2 col-sm-2">
    {!! Form::select('agentId', $componentAgent, request()->agentId, ['class' => 'form-control form-control-sm', 'placeholder' => 'All Agents']) !!}
</div>
