<div class="table-responsive">
    <table class="table" id="kriterias-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Bobot</th>
                <th>Weight</th>
                <th>Jenis</th>
                <th>Tipe</th>
                <th aria-colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriterias as $kriteria)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $kriteria->nama }}</td>
                    <td>{{ $kriteria->kode }}</td>
                    <td>{{ $kriteria->bobot }}</td>
                    <td>{{ $kriteria->bobot / 100 }}</td>
                    <td>
                        <p class="badge  {{ $kriteria->jenis == 'benefit' ? 'badge-success' : 'badge-secondary' }}">
                            {{ $kriteria->jenis }}</p>
                    </td>
                    <td>
                        <p class="badge  {{ $kriteria->tipe == 'single' ? 'badge-success' : 'badge-secondary' }}">
                            {{ $kriteria->tipe }}</p>
                    </td>
                    <td width="120">
                        {!! Form::open(['route' => ['kriterias.destroy', $kriteria->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('kriterias.edit', [$kriteria->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs btn-delete',
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: end;">Total : </th>
                <th>{{ $kriterias->sum('bobot') }}</th>
                <th>{{ $kriterias->sum('bobot') / 100 }}</th>
                <th colspan="3"></th>
            </tr>
        </tfoot>
    </table>
</div>
@push('third_party_scripts')
    @include('layouts.datatables_js')
    <script>
        $(function() {
            $('.table').DataTable({
                scrollX: true,
                responsive: true,
            });
            $('.btn-delete').click(function(event) {
                var form = $(this).closest("form")[0];
                event.preventDefault();
                Swal.fire({
                    title: "Are you sure!",
                    icon: 'warning',
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                }).catch((err) => {
                    console.log(err);
                });
            });
        })
    </script>
@endpush
