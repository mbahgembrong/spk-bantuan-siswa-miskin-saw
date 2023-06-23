<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
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
