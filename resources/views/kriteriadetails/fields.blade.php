<!-- Kriteria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kriteria_id', 'Kriteria Id:') !!}
    {!! Form::select('kriteria_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>


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

<!-- Kode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kode', 'Kode:') !!}
    {!! Form::text('kode', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipe', 'Tipe:') !!}
    {!! Form::text('tipe', null, ['class' => 'form-control']) !!}
</div>

<!-- Ket Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ket', 'Ket:') !!}
    {!! Form::text('ket', null, ['class' => 'form-control']) !!}
</div>