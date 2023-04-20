<!-- Siswa Id Field -->
<div class="col-sm-12">
    {!! Form::label('siswa_id', 'Siswa Id:') !!}
    <p>{{ $penilaian->siswa_id }}</p>
</div>

<!-- Kriteria Detail Id Field -->
<div class="col-sm-12">
    {!! Form::label('kriteria_detail_id', 'Kriteria Detail Id:') !!}
    <p>{{ $penilaian->kriteria_detail_id }}</p>
</div>

<!-- Bobot Field -->
<div class="col-sm-12">
    {!! Form::label('bobot', 'Bobot:') !!}
    <p>{{ $penilaian->bobot }}</p>
</div>

<!-- Ket Field -->
<div class="col-sm-12">
    {!! Form::label('ket', 'Ket:') !!}
    <p>{{ $penilaian->ket }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $penilaian->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $penilaian->updated_at }}</p>
</div>

