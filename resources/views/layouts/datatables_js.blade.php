<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
{{-- <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}
<script>
    $(function() {
        $('.table').DataTable({
            // scrollX: true,
            // responsive: true,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
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
