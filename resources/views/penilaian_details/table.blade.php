<div class="table-responsive">
    <table class="table" id="penilaianDetails-table">
        <thead>
        <tr>
            <th>Penilaian Id</th>
        <th>Kriteria Id</th>
        <th>Bobot</th>
        <th>Keterangan</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($penilaianDetails as $penilaianDetail)
            <tr>
                <td>{{ $penilaianDetail->penilaian_id }}</td>
            <td>{{ $penilaianDetail->kriteria_id }}</td>
            <td>{{ $penilaianDetail->bobot }}</td>
            <td>{{ $penilaianDetail->keterangan }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['penilaianDetails.destroy', $penilaianDetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('penilaianDetails.show', [$penilaianDetail->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('penilaianDetails.edit', [$penilaianDetail->id]) }}"
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
