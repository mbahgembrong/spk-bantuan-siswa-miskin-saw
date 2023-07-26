<!-- Nis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nis', 'NIS:') !!}
    {!! Form::text('nis', null, ['class' => 'form-control', 'readonly']) !!}
</div>
<!-- Nis Field -->
<div class="form-group col-sm-6" id="form_nisn">
    {!! Form::label('nisn', 'NISN:') !!}
    {!! Form::text('nisn', null, ['class' => 'form-control']) !!}
</div>
<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>
<!-- Jenis Kelamin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin:') !!}
    {!! Form::select('jenis_kelamin', ['L' => 'Laki-Laki', 'P' => 'Perempuan'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>


<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tanggal_lahir', null, [
        'class' => 'form-control',
        'id' => 'tanggal_lahir',
    ]) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_lahir').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: true,
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
@foreach ($kriterias as $kriteria)
    @if ($kriteria->tipe == 'single')
        <div class="form-group col-sm-6">
            {!! Form::label($kriteria->id, $kriteria->nama . ' :') !!}
            {!! Form::select($kriteria->id, $kriteria->kriteriaDetail()->pluck('nama', 'id'), null, [
                'class' => 'form-control',
            ]) !!}
        </div>
    @endif
@endforeach
@foreach ($kriterias as $kriteria)
    @if ($kriteria->tipe == 'multiple')
        <div class="form-group_{{ $kriteria->id }} col-sm-12" data-id="{{ $kriteria->id }}">
            <label for="jenis_kelaminModal" class="form-label">{{ $kriteria->nama . ' :' }}</label>
            <div class="form-group fieldGroup_{{ $kriteria->id }}" data-id="1" data-kode="{{ $kriteria->kode }}">
                <div class="input-group">
                    <input type="text" name="keterangan_{{ $kriteria->id }}[]"
                        class="form-control keterangan_{{ $kriteria->id }}" placeholder="Keterangan" />
                    @if ($kriteria->kode == 'nilai')
                        <input type="number" name="nilai_{{ $kriteria->id }}[]"
                            class="form-control nilai_{{ $kriteria->id }} form_nilai" placeholder="Nilai" />
                        <input type="hidden" name="{{ 'bobot_' . $kriteria->id . '[]' }}"
                            class="{{ 'bobot_' . $kriteria->id }}">
                    @else
                        {!! Form::select('bobot_' . $kriteria->id . '[]', $kriteria->kriteriaDetail()->pluck('nama', 'id'), null, [
                            'class' => 'form-control bobot_' . $kriteria->id,
                            'placeholder' => 'Masukkan Nilai',
                        ]) !!}
                    @endif

                    <div class="input-group-addon ml-3">
                        <a href="javascript:void(0)" class="btn btn-success addMore_{{ $kriteria->id }}"><i
                                class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @push('page_scripts')
            <script>
                $(function() {
                    $(document).on('click', '.addMore_{{ $kriteria->id }}', function() {
                        let data = $(this).parents('.fieldGroup_{{ $kriteria->id }}').data('id') + 1;
                        let kode = $(this).parents('.fieldGroup_{{ $kriteria->id }}').data('kode');
                        console.log(kode);
                        let fieldHTML = ''
                        if (kode == 'nilai') {
                            fieldHTML = `
                            <div class="mb-3 form-group_{{ $kriteria->id }} fieldGroup_{{ $kriteria->id }}" data-id="${data}">
                                <div class="input-group">
                                    <input type="text" name="keterangan_{{ $kriteria->id }}[]" class="form-control keterangan_{{ $kriteria->id }}" placeholder="Keterangan" />
                                    <input type="number" name="nilai_{{ $kriteria->id }}[]" class="form-control nilai_{{ $kriteria->id }} form_nilai" placeholder="Nilai" />
                                    <input type="hidden" name="{{ 'bobot_' . $kriteria->id . '[]' }}">
                                    <div class="input-group-addon ml-3">
                                        <a href="javascript:void(0)" class="btn btn-danger remove_{{ $kriteria->id }}"><i class="fa fa-minus"></i></a>
                                    </div>
                                </div>
                            </div>`
                        } else
                            fieldHTML =
                            '<div class="mb-3 form-group_{{ $kriteria->id }} fieldGroup_{{ $kriteria->id }}" data-id="' +
                            data + '">' +
                            '<div class="input-group">' +
                            '<input type="text" name="keterangan_{{ $kriteria->id }}[]" class = "form-control keterangan_{{ $kriteria->id }}" placeholder = "Keterangan" / > ' +
                            '{!! Form::select('bobot_' . $kriteria->id . '[]', $kriteria->kriteriaDetail()->pluck('nama', 'id'), null, [
                                'class' => 'form-control bobot_' . $kriteria->id,
                                'placeholder' => 'Masukkan Nilai',
                            ]) !!}' +
                            '<div class="input-group-addon ml-3">' +
                            '<a href="javascript:void(0)" class="btn btn-danger remove_{{ $kriteria->id }}"><i class="fa fa-minus"></i></a>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('.fieldGroup_{{ $kriteria->id }}:last').after(fieldHTML);
                    });
                    $(document).on('click', '.remove_{{ $kriteria->id }}', function() {
                        $(this).parents('.fieldGroup_{{ $kriteria->id }}').remove();
                    });
                })
            </script>
        @endpush
    @endif
@endforeach

<!-- Alamat Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
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
@push('page_scripts')
    <script>
        const dataNilai = {!! json_encode(
            $kriterias->where('kode', 'nilai')->first() != null
                ? $kriterias->where('kode', 'nilai')->first()->kriteriaDetail()->pluck('nama', 'id')
                : collect([]),
        ) !!}
        console.log(dataNilai);
        $(function() {
            $('input[name="nis"]').keyup(function(input) {
                if (input.target.value.match(/^\d*\.?\d*$/)) {
                    input.target.value = input.target.value;
                } else {
                    input.target.value = input.target.value.replace(/[^\d.-]+/g, '');
                }
            })
            tinymce.init({
                selector: 'textarea',
                init_instance_callback: function(editor) {
                    var freeTiny = document.querySelector('.tox .tox-notification--in');
                    freeTiny.style.display = 'none';
                }
            });
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview,
            );


            $(document).on('change', '.form_nilai', function(e) {
                e.preventDefault();
                const nilai = $(this).val();
                const idNilai = cekNilai(nilai);
                console.log(idNilai);
                $(this).next().val(idNilai)

            })

            function cekNilai(nilai) {
                // forin data nilai
                nilai = parseInt(nilai);
                let hasil = '';
                for (const key in dataNilai) {
                    if (dataNilai.hasOwnProperty(key)) {
                        let element = dataNilai[key];
                        element = element.split(' ');
                        hasil = ceker({
                            nilai,
                            element,
                            key
                        });
                        if (hasil) {
                            break;
                        }
                    }
                }
                return hasil;

            }

            function ceker({
                nilai,
                element,
                key
            }) {
                let digit = element.filter(e => {
                    return e.match(/^\d*\.?\d*$/);
                }).map(e => parseInt(e));
                let operator = element.filter(e => {
                    return e.match(/^[><=]+$/);
                });
                if (digit.length == 2) {
                    if (digit[0] < digit[1]) {
                        if (operator[0] == '>') {
                            if (nilai < digit[0] && nilai >= digit[1]) {
                                return key;
                            }
                        }
                        if (operator[0] == '<') {
                            if (nilai > digit[0] && nilai <= digit[1]) {
                                return key;
                            }

                        }
                        if (operator[0] == '=') {
                            if (nilai == digit[0] && nilai == digit[1]) {
                                return key;
                            }
                        }
                    } else {
                        if (operator[0] == '>') {
                            if (nilai >= digit[0] && nilai < digit[1]) {
                                return key;
                            }
                        }
                        if (operator[0] == '<') {
                            if (nilai <= digit[0] && nilai > digit[1]) {
                                return key;
                            }
                        }
                        if (operator[0] == '=') {
                            if (nilai == digit[0] && nilai == digit[1]) {
                                return key;
                            }
                        }
                    }
                } else {
                    if (operator == '>') {
                        if (nilai >= digit) {
                            return key;
                        }
                    }
                    if (operator == '<') {
                        if (nilai <= digit) {
                            return key;
                        }
                    }
                    if (operator == '=') {
                        if (nilai == digit) {
                            return key;
                        }
                    }
                }
            }
        })
    </script>
@endpush
