<input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">
@if ($kriteria->kode == 'penghasilan')
    <!-- Nama Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('nama', 'Nama:') !!}
        {{-- <div class="example"></div> --}}
        <div class="slider-container ml-2 mr-2">
            <input type="text" id="slider" class="slider" />
            <input type="hidden" name="nama" value="{{ $kriteria->kode }}">
            <input type="hidden" name="range_awal" value="">
            <input type="hidden" name="range_akhir" value="">
        </div>
    </div>
    @push('page_css')
        <link rel="stylesheet"
            href="https://www.cssscript.com/demo/animated-customizable-range-slider-pure-javascript-rslider-js/css/rSlider.min.css" />
    @endpush
    @push('page_scripts')
        <script
            src="https://www.cssscript.com/demo/animated-customizable-range-slider-pure-javascript-rslider-js/js/rSlider.min.js">
        </script>
        <script>
            (function() {
                'use strict';

                var init = function() {
                    var slider = new rSlider({
                        target: '#slider',
                        values: ['500.000', '750.000', '1.000.000',
                            '2.000.000'
                        ],
                        range: true,
                        set: ["{{ $range['rangeAwal'] ?? '500.000' }}", "{{ $range['rangeAkhir'] ?? '0' }}"],
                        onChange: function(vals) {
                            $('input[name="range_awal"]').val(vals.split(',')[0])
                            $('input[name="range_akhir"]').val(vals.split(',')[1])
                        }
                    });
                };
                window.onload = init;
            })();
        </script>
    @endpush
@else
    <!-- Nama Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('nama', 'Nama:') !!}
        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
    </div>
@endif
<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kode', 'Kode:') !!}
    {!! Form::text('kode', null, ['class' => 'form-control']) !!}
</div>

<!-- Bobot Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bobot', 'Bobot:') !!}
    {!! Form::number('bobot', null, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
</div>
<!-- Tipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipe', 'Tipe:') !!}
    {!! Form::text('tipe', null, ['class' => 'form-control']) !!}
</div>
