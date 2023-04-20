@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bantuan Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('bantuans.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3 ">
        {{-- card kriteria --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Ambil nilai Weight: bobot kriteria / 100 (%)</h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle;">#</th>
                                        <th class="text-center" style="vertical-align: middle;">Nama</th>
                                        <th class="text-center" style="vertical-align: middle;">Bobot</th>
                                        <th class="text-center" style="vertical-align: middle;">Weight (%)</th>
                                        <th class="text-center" style="vertical-align: middle;">Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vectorBobot as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->bobot }}</td>
                                            <td>{{ $value->bobot / 100 }}</td>
                                            <td>{{ $value->jenis }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- card rumus kriteria --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Langkah 1-2 : Buat nilai bobot Fuzzy dari setiap siswa berdasarkan kriteria dan cari max dan
                            min bobot pada setiap kriteria berdasarkan jenis kriteria</h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle;">#</th>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle;">Nama</th>
                                        @foreach ($nilaiRumusKriteria as $jenisVector => $vector)
                                            <th colspan="{{ count($vector) * 2 }}" class="text-center"
                                                style="vertical-align: middle;">
                                                {{ $jenisVector }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th colspan="2" class="text-center text-nowrap"
                                                    style="vertical-align: middle;">
                                                    {{ $vector['vector_nama'] }}</th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">Nilai
                                                </th>
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">Bobot
                                                </th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($nilaiFuzzy as $siswa)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="text-no-wrap">{{ $siswa['siswa_nama'] }}</td>
                                            @foreach ($siswa['bobot'] as $bobot)
                                                @foreach ($bobot as $nilai)
                                                    <td>{{ $nilai['bobot'] }}</td>
                                                    <td><span class="badge badge-primary w-100 h-100">
                                                            {{ $nilai['bobot'] / 100 }}</span>
                                                    </td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-center text-nowrap">Nilai </th>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th class="text-center text-nowrap">
                                                    {{ $vector['jenis_penilaian'] }} : </th>
                                                <th class="text-center">{{ $vector['penilaian'] }}</th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- card normalisasi --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Langkah 3 : Melakukan normalisasi dengan menghitung masing-masing kriteria berdasarkan rumus
                        </h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle;">#</th>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle;">Nama</th>
                                        @foreach ($nilaiRumusKriteria as $jenisVector => $vector)
                                            <th colspan="{{ count($vector) * 3 }}" class="text-center"
                                                style="vertical-align: middle;">
                                                {{ $jenisVector }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th colspan="3" class="text-center text-nowrap"
                                                    style="vertical-align: middle;">
                                                    {{ $vector['vector_nama'] }}</th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">Bobot
                                                </th>
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">
                                                    {{ $vector['jenis_penilaian'] }}
                                                </th>
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">
                                                    {{ $vector['jenis_penilaian'] == 'max' ? 'Bobot/' . $vector['jenis_penilaian'] : $vector['jenis_penilaian'] . '/Bobot' }}
                                                </th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($nilaiFuzzy as $siswa)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="text-no-wrap">{{ $siswa['siswa_nama'] }}</td>
                                            @foreach ($siswa['bobot'] as $bobot)
                                                @foreach ($bobot as $nilai)
                                                    <td>{{ $nilai['bobot'] }}</td>
                                                    <td>{{ $nilai['penilaian'] }}</td>
                                                    <td><span class="badge badge-primary w-100 h-100">
                                                            {{ $nilai['nilai_normalisasi'] }}
                                                        </span>
                                                    </td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- card  Nilai Akhir --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Langkah 4 : Ambil weight kriteria kemudian kalikan Nilai Normalisasi
                        </h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle;">#</th>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle;">Nama</th>
                                        @foreach ($nilaiRumusKriteria as $jenisVector => $vector)
                                            <th colspan="{{ count($vector) * 3 }}" class="text-center"
                                                style="vertical-align: middle;">
                                                {{ $jenisVector }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th colspan="3" class="text-center text-nowrap"
                                                    style="vertical-align: middle;">
                                                    {{ $vector['vector_nama'] }}</th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">Nilai
                                                    Normalisasi
                                                </th>
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">
                                                    Weight Kriteria
                                                </th>
                                                <th class="text-center" style="vertical-align: middle;">
                                                    Nilai Noramlisasi X Weight Kriteria
                                                </th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($nilaiFuzzy as $siswa)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="text-no-wrap">{{ $siswa['siswa_nama'] }}</td>
                                            @foreach ($siswa['bobot'] as $bobot)
                                                @foreach ($bobot as $nilai)
                                                    <td>{{ $nilai['nilai_normalisasi'] }}</td>
                                                    <td>{{ $nilai['bobot_kriteria'] }}</td>
                                                    <td><span class="badge badge-primary w-100 h-100">
                                                            {{ $nilai['nilai_akhir'] }}
                                                        </span>
                                                    </td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- card  Total Nilai Akhir --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Langkah 5 : Jumlahkan Weight Normalisasi
                        </h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">#</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Nama</th>
                                        @foreach ($nilaiRumusKriteria as $jenisVector => $vector)
                                            <th colspan="{{ count($vector) }}" class="text-center"
                                                style="vertical-align: middle;">
                                                {{ $jenisVector }}
                                            </th>
                                        @endforeach
                                        <th rowspan="2" class="text-center text-nowrap"
                                            style="vertical-align: middle;">Nilai Akhir
                                        </th>
                                    </tr>
                                    <tr>
                                        @foreach ($nilaiRumusKriteria as $item)
                                            @foreach ($item as $vector)
                                                <th class="text-center text-nowrap" style="vertical-align: middle;">
                                                    {{ $vector['vector_nama'] }}</th>
                                            @endforeach
                                        @endforeach

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($nilaiFuzzy as $siswa)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="text-no-wrap">{{ $siswa['siswa_nama'] }}</td>
                                            @foreach ($siswa['bobot'] as $bobot)
                                                @foreach ($bobot as $nilai)
                                                    <td> {{ $nilai['nilai_akhir'] }}</td>
                                                @endforeach
                                            @endforeach
                                            <td><span class="badge badge-primary w-100 h-100">
                                                    {{ $siswa['total_nilai'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Hasil --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Hasil : Daftar Penerima Bantuan
                        </h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle;">#</th>
                                        <th class="text-center" style="vertical-align: middle;">Nama</th>
                                        <th class="text-center text-nowrap" style="vertical-align: middle;">Nilai Akhir
                                        </th>
                                        <th class="text-center text-nowrap" style="vertical-align: middle;">Menerima
                                            Bantuan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        usort($nilaiFuzzy, function ($a, $b) {
                                            return $b['total_nilai'] <=> $a['total_nilai'];
                                        });
                                        foreach ($nilaiFuzzy as $key => $value) {
                                            if ($key + 1 <= $bantuan->kuota) {
                                                $nilaiFuzzy[$key]['menerima_bantuan'] = 'Ya';
                                            } else {
                                                $nilaiFuzzy[$key]['menerima_bantuan'] = 'Tidak';
                                            }
                                        }
                                    @endphp
                                    @foreach ($nilaiFuzzy as $siswa)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td class="text-no-wrap">{{ $siswa['siswa_nama'] }}</td>
                                            <td class="text-no-wrap">{{ $siswa['total_nilai'] }}</td>
                                            <td><span class="badge badge-primary w-100 h-100">
                                                    {{ $siswa['menerima_bantuan'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $(function() {
            console.log($('.table'));
            $('.table').each((i, value) => {
                $(value).DataTable().destroy();
            });
        })
    </script>
@endpush
>
