<!-- Penilaian Id Field -->
<div class="col-sm-12">
    {!! Form::label('penilaian_id', 'Penilaian Id:') !!}
    <p>{{ $penilaianDetail->penilaian_id }}</p>
</div>

<!-- Kriteria Id Field -->
<div class="col-sm-12">
    {!! Form::label('kriteria_id', 'Kriteria Id:') !!}
    <p>{{ $penilaianDetail->kriteria_id }}</p>
</div>

<!-- Bobot Field -->
<div class="col-sm-12">
    {!! Form::label('bobot', 'Bobot:') !!}
    <p>{{ $penilaianDetail->bobot }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{{ $penilaianDetail->keterangan }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $penilaianDetail->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $penilaianDetail->updated_at }}</p>
</div>

