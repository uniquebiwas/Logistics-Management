<div class="form-group row @error('country_id') has-error @enderror">
    {{ Form::label('country_id', 'Countries :*', ['class' => 'col-sm-3']) }}
    <div class="col-sm-9">
        {!! Form::select('country_id[]', $countries, $selected, ['class' => 'form-control select2', 'multiple' => true, 'id' => 'country_id', 'placeholder' => 'Select Countries', 'required' => true, 'style' => 'width:80%']) !!} @error('country_id')
            <span class="help-block error"><small>{{ $message }}</small></span>
        @enderror
    </div>
</div>
