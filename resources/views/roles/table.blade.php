<div class="table-responsive">
    <table class="table" id="roles-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Role</th>
                <th aria-colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $index => $role)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $role->role }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{-- <a href="{{ route('roles.show', [$role->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('roles.edit', [$role->id]) }}" class='btn btn-default btn-xs'>
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
