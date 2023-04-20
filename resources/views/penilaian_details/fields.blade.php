<!-- Penilaian Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('penilaian_id', 'Penilaian Id:') !!}
    {!! Form::select('penilaian_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Kriteria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kriteria_id', 'Kriteria Id:') !!}
    {!! Form::select('kriteria_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Bobot Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bobot', 'Bobot:') !!}
    {!! Form::text('bobot', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>