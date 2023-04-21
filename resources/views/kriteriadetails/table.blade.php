<div class="table-responsive">
    <table class="table" id="kriteriadetails-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Bobot</th>
                <th>Weight</th>
                <th>Tipe</th>
                <th aria-colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriteriadetails as $index => $kriteriadetail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kriteriadetail->nama }}</td>
                    <td>{{ $kriteriadetail->kode }}</td>
                    <td>{{ $kriteriadetail->bobot }}</td>
                    <td>{{ $kriteriadetail->bobot / 100 }}</td>
                    <td>{{ $kriteriadetail->tipe }}</td>
                    <td width="120">
                        {!! Form::open([
                            'route' => ['kriteriadetails.destroy', ['kriteriaId' => $kriteria->id, 'id' => $kriteriadetail->id]],
                            'method' => 'delete',
                        ]) !!}
                        <div class='btn-group'>
                            <a href="{{ route('kriteriadetails.edit', ['kriteriaId' => $kriteria->id, 'id' => $kriteriadetail->id]) }}"
                                class='btn btn-default btn-xs'>
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
