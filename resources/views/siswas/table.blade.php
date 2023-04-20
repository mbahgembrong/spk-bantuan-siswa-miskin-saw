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
                    <td>{{ $siswa->foto }}</td>
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
