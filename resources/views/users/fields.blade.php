<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama :') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role :') !!}
    {!! Form::select('role_id', ['' => 'Pilih Role'] + $roles->toArray(), null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email :') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password :') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Foto :') !!}
    {!! Form::file('image', ['class' => 'form-control']) !!}
</div>
