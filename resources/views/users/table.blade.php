<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Image</th>
                <th aria-colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role }}</td>
                    <td> <img class="boxed--square--detail" src="{{ asset('storage/users/foto/' . $user->foto) }}"
                            onerror="this.onerror=null; this.src='{{ asset('img/no-image.jpg') }}'" /></td>
                    <td width="120">
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{-- <a href="{{ route('users.show', [$user->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-default btn-xs'>
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
