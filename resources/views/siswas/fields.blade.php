<!-- Nis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nis', 'Nis:') !!}
    {!! Form::text('nis', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Alamat Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    {!! Form::select('jenis_kelamin', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tanggal_lahir', null, ['class' => 'form-control','id'=>'tanggal_lahir']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_lahir').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Ibu Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ibu', 'Ibu:') !!}
    {!! Form::text('ibu', null, ['class' => 'form-control']) !!}
</div>

<!-- Ayah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ayah', 'Ayah:') !!}
    {!! Form::text('ayah', null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('foto', ['class' => 'custom-file-input']) !!}
            {!! Form::label('foto', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
