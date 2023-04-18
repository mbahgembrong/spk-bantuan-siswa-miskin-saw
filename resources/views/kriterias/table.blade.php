<div class="table-responsive">
    <table class="table" id="kriterias-table">
        <thead>
        <tr>
            <th>Nama</th>
        <th>Bobot</th>
        <th>Tipe</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kriterias as $kriteria)
            <tr>
                <td>{{ $kriteria->nama }}</td>
            <td>{{ $kriteria->bobot }}</td>
            <td>{{ $kriteria->tipe }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['kriterias.destroy', $kriteria->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('kriterias.show', [$kriteria->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('kriterias.edit', [$kriteria->id]) }}"
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
