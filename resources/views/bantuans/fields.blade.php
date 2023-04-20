<div class="form-group col-sm-12">
    {!! Form::label('nama', 'Nama :') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('jumlah', 'Jumlah :') !!}
    {!! Form::number('jumlah', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('kuota', 'Kuota :') !!}
    {!! Form::number('kuota', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status :') !!}
    {!! Form::select('status', ['proses' => 'proses', 'selesai' => 'selesai'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('ganda', 'Ganda :') !!}
    {!! Form::select('ganda', [true => 'Ya', false => 'Tidak'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan :') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
</div>

@push('page_scripts')
    <script>
        $(function() {
            tinymce.init({
                selector: 'textarea',
                init_instance_callback: function(editor) {
                    var freeTiny = document.querySelector('.tox .tox-notification--in');
                    freeTiny.style.display = 'none';
                }
            });
        })
    </script>
@endpush
