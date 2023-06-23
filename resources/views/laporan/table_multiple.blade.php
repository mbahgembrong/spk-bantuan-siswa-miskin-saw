<div class="table-responsive">
    <table class="table table-bordered" id="table_multiple">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align: middle;">#</th>
                <th class="text-center" style="vertical-align: middle;">NISN</th>
                <th class="text-center" style="vertical-align: middle;">Nama Siswa</th>
                <th class="text-center" style="vertical-align: middle;">Data</th>
                <th></th>
            </tr>
            <tr>
                <th style="display: none;">#</th>
                <th style="display: none;">NISN</th>
                <th style="display: none;">Nama Siswa</th>
                <th class="text-center" style="vertical-align: middle;">Keterangan</th>
                <th class="text-center" style="vertical-align: middle;">Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
                @foreach ($data->siswaDetail()->where('kriteria_id', $kriteriaId)->whereNull('kriteria_detail_id')->first()->subSiswaDetail as $subSiswaDetai)
                    <tr
                        data-rowcount="{{ $data->siswaDetail()->where('kriteria_id', $kriteriaId)->whereNull('kriteria_detail_id')->first()->subSiswaDetail->count() }}">
                        <td class="text-center" style="vertical-align: middle;">{{ $index + 1 }}</td>
                        <td class="text-center" style="vertical-align: middle;">
                            {{ $data->nisn ?? '-' }}</td>
                        <td class="text-center" style="vertical-align: middle;">
                            {{ $data->nama }}</td>
                        <td>{{ $subSiswaDetai->keterangan }}</td>
                        <td>{{ $subSiswaDetai->kriteriaDetailId->nama }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@push('third_party_scripts')
    @include('layouts.datatables_js')
@endpush

@push('page_scripts')
    <script>
        $(function() {
            $('#table_multiple').DataTable().destroy();
            let indexTable = 0;
            $('#table_multiple').DataTable({
                responsive: true,
                "paging": false,
                "searching": false,
                "info": false,
                "ordering": false,
                dom: 'Bfrtip',
                buttons: [{
                    title: 'Laporan ',
                    extend: 'excelHtml5',
                    exportOptions: {
                        modifier: {
                            page: 'current',

                        },
                        columns: [1, 2, 3],
                    }
                }, {
                    title: 'Laporan ',
                    extend: 'pdfHtml5',
                    exportOptions: {
                        modifier: {
                            page: 'current',

                        },
                        columns: [1, 2, 3],
                    }
                }, {
                    title: 'Laporan ',
                    extend: 'print',
                    exportOptions: {
                        modifier: {
                            page: 'current',

                        },
                        columns: [1, 2, 3],
                    }
                }],
                'headerCallback': function(thead, data, start, end, display) {
                    const header = $(thead);
                    header.find('th').eq(0).attr('rowspan', 2);
                    header.find('th').eq(1).attr('rowspan', 2);
                    header.find('th').eq(2).attr('rowspan', 2);
                    header.find('th').eq(3).attr('colspan', 2);
                    header.find('th').eq(4).remove();
                    return header;
                },
                'createdRow': function(row, data, dataIndex) {
                    if (data[0] != indexTable) {
                        const rowCount = parseInt($(row).data('rowcount'));
                        $('td:eq(0)', row).attr('rowspan', rowCount);
                        $('td:eq(1)', row).attr('rowspan', rowCount);
                        $('td:eq(2)', row).attr('rowspan', rowCount);
                    } else {
                        $('td:eq(0)', row).hide();
                        $('td:eq(1)', row).hide();
                        $('td:eq(2)', row).hide();
                    }
                    indexTable = data[0];
                }
            })
        })
    </script>
@endpush
