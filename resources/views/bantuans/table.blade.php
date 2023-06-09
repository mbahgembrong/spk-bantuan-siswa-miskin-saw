<div class="table-responsive">
    <table class="table" id="bantuans-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Kuota</th>
                <th>Status</th>
                <th>Ganda</th>
                <th>Keterangan</th>
                <th aria-colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bantuans as $index => $bantuan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bantuan->nama }}</td>
                    <td>Rp. {{ $bantuan->jumlah }}</td>
                    <td>{{ $bantuan->kuota }}</td>
                    <td>
                        <p class="badge  {{ $bantuan->status == 'selesai' ? 'badge-success' : 'badge-secondary' }}">
                            {{ $bantuan->status }}</p>
                    <td>{{ $bantuan->ganda ? 'Ya' : 'Tidak' }}</td>
                    <td>{!! $bantuan->keterangan !!}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['bantuans.destroy', $bantuan->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @if ($bantuan->status != 'selesai' && Auth::user()->role->role == 'admin')
                                <a href="{{ route('bantuans.proses', [$bantuan->id]) }}" class='btn btn-success btn-xs'>
                                    <i class=" fas fa-angle-double-right"></i>
                                </a>
                                <a href="{{ route('bantuans.edit', [$bantuan->id]) }}" class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs btn-delete',
                                ]) !!}
                            @else
                                <a href="{{ route('bantuans.pdf', [$bantuan->id]) }}" class='btn btn-success btn-xs'
                                    target="_blank">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            @endif


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
@endpush
