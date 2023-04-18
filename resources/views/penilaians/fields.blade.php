<!-- Siswa Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('siswa_id', 'Siswa Id:') !!}
    {!! Form::select('siswa_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Kriteria Detail Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kriteria_detail_id', 'Kriteria Detail Id:') !!}
    {!! Form::select('kriteria_detail_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Bobot Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bobot', 'Bobot:') !!}
    {!! Form::text('bobot', null, ['class' => 'form-control']) !!}
</div>

<!-- Ket Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ket', 'Ket:') !!}
    {!! Form::text('ket', null, ['class' => 'form-control']) !!}
</div>