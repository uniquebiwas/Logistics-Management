@props(['name' => 'password', 'required' => true, 'label' => 'password'])

<div class="input-group mb-3">
    {!! Form::label($name, $label, ['class' => 'col-3']) !!}
    <div class="col-8 d-flex">
        <input type="password" class="form-control" name="{{ $name }}" id="{{ $name }}"
            placeholder="password">
        <div class="input-group-append  passwordChange">
            <span class="input-group-text"><i class="fas fa-eye"></i></span>
        </div>
    </div>
</div>


