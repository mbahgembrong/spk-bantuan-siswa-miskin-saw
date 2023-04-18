<div class="table-responsive">
    <table class="table" id="kriteriadetails-table">
        <thead>
        <tr>
            <th>Kriteria Id</th>
        <th>Nama</th>
        <th>Bobot</th>
        <th>Kode</th>
        <th>Tipe</th>
        <th>Ket</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kriteriadetails as $kriteriadetail)
            <tr>
                <td>{{ $kriteriadetail->kriteria_id }}</td>
            <td>{{ $kriteriadetail->nama }}</td>
            <td>{{ $kriteriadetail->bobot }}</td>
            <td>{{ $kriteriadetail->kode }}</td>
            <td>{{ $kriteriadetail->tipe }}</td>
            <td>{{ $kriteriadetail->ket }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['kriteriadetails.destroy', $kriteriadetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('kriteriadetails.show', [$kriteriadetail->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('kriteriadetails.edit', [$kriteriadetail->id]) }}"
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
