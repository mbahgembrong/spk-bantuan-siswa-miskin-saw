<div class="table-responsive">
    <table class="table" id="kriterias-table">
        <thead>
            <tr>
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
    </table>
</div>
