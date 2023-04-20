<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('kode', 'Kode:') !!}
    {!! Form::text('kode', null, ['class' => 'form-control']) !!}
</div>
<!-- Bobot Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bobot', 'Bobot:') !!}
    {!! Form::number('bobot', null, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
</div>
<!-- Tipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis', 'Jenis:') !!}
    {!! Form::select('jenis', ['benefit' => 'benefit', 'cost' => 'cost'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>
<!-- Tipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipe', 'Tipe:') !!}
    {!! Form::select('tipe', ['single' => 'single', 'multiple' => 'multiple'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>
