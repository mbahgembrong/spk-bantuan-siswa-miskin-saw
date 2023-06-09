<div class="table-responsive">
    <table class="table table-bordered" id="table_multiple">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align: middle;">#</th>
                <th class="text-center" style="vertical-align: middle;">Nama Siswa</th>
                <th class="text-center" style="vertical-align: middle;">Data</th>
                <th></th>
            </tr>
            <tr>
                <th style="display: none;">#</th>
                <th style="display: none;">Nama Siswa</th>
                <th class="text-center" style="vertical-align: middle;">Keterangan</th>
                <th class="text-center" style="vertical-align: middle;">Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $data)
                <tr
                    data-rowcount="{{ $data->siswaDetail()->where('kriteria_id', $kriteriaId)->whereNull('kriteria_detail_id')->first()->subSiswaDetail->count() }}">
                    <td class="text-center" style="vertical-align: middle;">{{ $index + 1 }}</td>
                    <td class="text-center" style="vertical-align: middle;">
                        {{ $data->nama }}</td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach ($data->siswaDetail()->where('kriteria_id', $kriteriaId)->whereNull('kriteria_detail_id')->first()->subSiswaDetail as $subSiswaDetai)
                    <tr>
                        <td style="display:none;"></td>
                        <td style="display:none;"></td>
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
            $('#table_multiple').DataTable({
                responsive: true,
                "paging": false,
                "searching": false,
                "info": false,
                "ordering": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', {
                        title: 'Laporan ',
                        extend: 'print',
                        text: 'Print',
                        autoPrint: true,
                        customize: function(win) {
                            $(win.document.body).find('table').addClass('display').css('font-size',
                                '9px');

                            $(win.document.body).find('h1').css('text-align', 'center');
                        },
                        exportOptions: {
                            modifier: {
                                page: 'current',
                            }
                        }
                    }
                ],
                'headerCallback': function(thead, data, start, end, display) {
                    const header = $(thead);
                    header.find('th').eq(0).attr('rowspan', 2);
                    header.find('th').eq(1).attr('rowspan', 2);
                    header.find('th').eq(2).attr('colspan', 2);
                    header.find('th').eq(3).remove();
                    return header;
                },
                'createdRow': function(row, data, dataIndex) {
                    if (data[1] !== '') {
                        const rowCount = parseInt($(row).data('rowcount')) + 1;
                        $('td:eq(0)', row).attr('rowspan', rowCount);
                        $('td:eq(1)', row).attr('rowspan', rowCount);
                        $('td:eq(2)', row).remove();
                        $('td:eq(2)', row).remove();

                    }
                }
            })
        })
    </script>
@endpush
