<div class="table-responsive">
    <table class="table" id="siswas-table">
        <thead>
            <tr>
                <th>#</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Ibu</th>
                <th>Ayah</th>
                <th>Foto</th>
                <th>Alamat</th>
                <th aria-colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $index => $siswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-Laki' }}</td>
                    <td>{{ Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') }}</td>
                    <td>{{ $siswa->ibu }}</td>
                    <td>{{ $siswa->ayah }}</td>
                    <td> <img class="boxed--square--detail" src="{{ asset('storage/siswas/foto/' . $siswa->foto) }}"
                            onerror="this.onerror=null; this.src='{{ asset('img/no-image.jpg') }}'" /></td>
                    <td>{!! $siswa->alamat !!}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['siswas.destroy', $siswa->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{-- <a href="{{ route('siswas.show', [$siswa->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('siswas.edit', [$siswa->id]) }}" class='btn btn-default btn-xs'>
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
@push('page_css')
    <style>
        .boxed--square--detail {
            border-radius: 10%;
            width: 8em;
            height: 8em;
            object-fit: fill;
            box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
            -moz-box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
        }

        tbody tr td {
            vertical-align: middle !important;
        }
    </style>
@endpush
