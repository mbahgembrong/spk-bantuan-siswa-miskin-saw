<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Bobot Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bobot', 'Bobot:') !!}
    {!! Form::text('bobot', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipe', 'Tipe:') !!}
    {!! Form::select('tipe', ], null, ['class' => 'form-control custom-select']) !!}
</div>
