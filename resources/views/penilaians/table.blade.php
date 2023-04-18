<div class="table-responsive">
    <table class="table" id="penilaians-table">
        <thead>
        <tr>
            <th>Siswa Id</th>
        <th>Kriteria Detail Id</th>
        <th>Bobot</th>
        <th>Ket</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($penilaians as $penilaian)
            <tr>
                <td>{{ $penilaian->siswa_id }}</td>
            <td>{{ $penilaian->kriteria_detail_id }}</td>
            <td>{{ $penilaian->bobot }}</td>
            <td>{{ $penilaian->ket }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['penilaians.destroy', $penilaian->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('penilaians.show', [$penilaian->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('penilaians.edit', [$penilaian->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
