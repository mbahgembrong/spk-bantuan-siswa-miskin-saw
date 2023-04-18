<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $kriteria->nama }}</p>
</div>

<!-- Bobot Field -->
<div class="col-sm-12">
    {!! Form::label('bobot', 'Bobot:') !!}
    <p>{{ $kriteria->bobot }}</p>
</div>

<!-- Tipe Field -->
<div class="col-sm-12">
    {!! Form::label('tipe', 'Tipe:') !!}
    <p>{{ $kriteria->tipe }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $kriteria->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $kriteria->updated_at }}</p>
</div>

