@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Siswa</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($siswa, ['route' => ['siswas.update', $siswa->id], 'method' => 'patch', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('siswas.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('siswas.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $(function() {
            $('#tanggal_lahir').val(moment("{{ $siswa->tanggal_lahir }}", 'YYYY-MM-DD').format('DD/MM/YYYY'));

        })
    </script>
    @foreach ($siswa->siswaDetail()->where('kriteria_detail_id', null)->with('subSiswaDetail')->get() as $siswaDetail)
        <script>
            $(function() {
                const siswaDetail = {!! json_encode($siswaDetail) !!};
                @foreach ($siswaDetail->subSiswaDetail as $key => $value)
                    @if ($key == 0)
                        $('.keterangan_{{ $siswaDetail->kriteria_id }}').val("{{ $value->keterangan }}");
                        $('.bobot_{{ $siswaDetail->kriteria_id }}').val("{{ $value->kriteria_detail_id }}");
                    @else
                        var fieldHTML =
                            '<div class="mb-3 form-group_{{ $siswaDetail->kriteria_id }} fieldGroup_{{ $siswaDetail->kriteria_id }}" data-id="{{ $key + 1 }}">' +
                            '<div class="input-group">' +
                            '<input type="text" name="keterangan_{{ $siswaDetail->kriteria_id }}[]" class = "form-control keterangan_{{ $siswaDetail->kriteria_id }}" placeholder = "Keterangan" value="{{ $value->keterangan }}" /> ' +
                            '{!! Form::select(
                                'bobot_' . $siswaDetail->kriteria_id . '[]',
                                $kriterias->find($siswaDetail->kriteria_id)->kriteriaDetail->pluck('nama', 'id'),
                                $value->kriteria_detail_id,
                                [
                                    'class' => 'form-control bobot_' . $siswaDetail->kriteria_id,
                                    'placeholder' => 'Masukkan Nilai',
                                ],
                            ) !!}' +
                            '<div class="input-group-addon ml-3">' +
                            '<a href="javascript:void(0)" class="btn btn-danger remove_{{ $siswaDetail->kriteria_id }}"><i class="fa fa-minus"></i></a>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('.fieldGroup_{{ $siswaDetail->kriteria_id }}:last').after(fieldHTML);
                    @endif
                @endforeach
            })
        </script>
    @endforeach
@endpush
