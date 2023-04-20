<!-- Siswa Id Field -->
<div class="col-sm-12">
    {!! Form::label('siswa_id', 'Siswa Id:') !!}
    <p>{{ $bantuan->siswa_id }}</p>
</div>

<!-- Kriteria Detail Id Field -->
<div class="col-sm-12">
    {!! Form::label('kriteria_detail_id', 'Kriteria Detail Id:') !!}
    <p>{{ $bantuan->kriteria_detail_id }}</p>
</div>

<!-- Bobot Field -->
<div class="col-sm-12">
    {!! Form::label('bobot', 'Bobot:') !!}
    <p>{{ $bantuan->bobot }}</p>
</div>

<!-- Ket Field -->
<div class="col-sm-12">
    {!! Form::label('ket', 'Ket:') !!}
    <p>{{ $bantuan->ket }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bantuan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $bantuan->updated_at }}</p>
</div>

