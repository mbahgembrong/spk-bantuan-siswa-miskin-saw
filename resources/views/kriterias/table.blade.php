<div class="table-responsive">
    <table class="table" id="kriterias-table">
        <thead>
            <tr>
                <th>#</th>
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
                <tr data-id="{{ $kriteria->id }}" class="table-data">
                    <td>{{ $loop->index + 1 }}</td>
                    <td><input type="text" class="form-control nama" name="nama[{{ $kriteria->id }}]"
                            value="{{ $kriteria->nama }}"></td>
                    <td><input type="text" class="form-control kode" name="kode[{{ $kriteria->id }}]"
                            value="{{ $kriteria->kode }}"></td>
                    <td> <input type="number" class="form-control bobot" name="bobot[{{ $kriteria->id }}]"
                            value="{{ $kriteria->bobot }}"></td>
                    <td class="weight">{{ $kriteria->bobot / 100 }}</td>
                    <td>
                        <select name="bobot[{{ $kriteria->id }}]" class="form-control jenis"
                            value="{{ $kriteria->jenis }}">
                            <option value="" disabled selected>Pilih Jenis</option>
                            <option value="benefit" {{ $kriteria->jenis == 'benefit' ? 'selected' : '' }}>Benefit
                            </option>
                            <option value="cost" {{ $kriteria->jenis == 'cost' ? 'selected' : '' }}>Cost</option>
                        </select>
                        {{-- <p class="badge  {{ $kriteria->jenis == 'benefit' ? 'badge-success' : 'badge-secondary' }}">
                            {{ $kriteria->jenis }}</p> --}}
                    </td>
                    <td>
                        <select name="tipe[{{ $kriteria->id }}]" class="form-control tipe"
                            value="{{ $kriteria->tipe }}">
                            <option value="" disabled selected>Pilih Tipe</option>
                            <option value="single" {{ $kriteria->tipe == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="multiple" {{ $kriteria->tipe == 'multiple' ? 'selected' : '' }}>Multiple
                            </option>
                        </select>
                        {{-- <p class="badge  {{ $kriteria->tipe == 'single' ? 'badge-success' : 'badge-secondary' }}">
                            {{ $kriteria->tipe }}</p> --}}
                    </td>
                    <td width="80">
                        {!! Form::open(['route' => ['kriterias.destroy', $kriteria->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{-- <a href="{{ route('kriterias.edit', [$kriteria->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a> --}}
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
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: end;">Total : </th>
                <th>{{ $kriterias->sum('bobot') }}</th>
                <th>{{ $kriterias->sum('bobot') / 100 }}</th>
                <th colspan="3"></th>
            </tr>
        </tfoot>
    </table>
</div>
@push('page_css')
    <style>
        div.table-responsive {
            padding: 1em;
        }

        div.dataTables_wrapper {
            display: inline-block;
            margin: 1em;
            width: -webkit-fill-available;
        }

        .form-control {
            width: auto;
        }

        table.dataTable {
            width: -webkit-fill-available !important;

        }

        table.dataTable thead .sorting:after {
            opacity: 0;
        }

        table.dataTable thead .sorting_asc:after {
            opacity: 0;
        }

        table.dataTable thead .sorting_desc:after {
            opacity: 0;
        }

        .dataTable>thead>tr>th[class*="sort"]:before,
        .dataTable>thead>tr>th[class*="sort"]:after {
            content: "" !important;
        }
    </style>
@endpush
@push('third_party_scripts')
    @include('layouts.datatables_js')
    <script>
        $(function() {
            $('.table').DataTable({
                // scrollX: true,
                responsive: true,
                "searching": false,
                "paging": false
            });
            let totalBobot = {{ $kriterias->sum('bobot') }};
            let tempRow = {
                nama: '',
                kode: '',
                bobot: '',
                jenis: '',
                tipe: ''
            };
            $('#btn-add').click(function(e) {
                e.preventDefault();
                let countRow = $('.table tbody tr').length;
                const row = `
                    <tr data-id="">
                        <td>${countRow+1}</td>
                        <td><input type="text" class="form-control nama" ></td>
                        <td><input type="text" class="form-control kode" name="kode[]"></td>
                        <td> <input type="number" class="form-control bobot" name="bobot[]"></td>
                        <td class="weight"></td>
                        <td>
                            <select name="jenis[]" class="form-control jenis">
                                <option value="" disabled selected>Pilih Jenis</option>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </td>
                        <td>
                            <select name="tipe[]" class="form-control tipe">
                                <option value="" disabled selected>Pilih Tipe</option>
                                <option value="single">Single</option>
                                <option value="multiple">Multiple</option>
                            </select>
                        </td>
                        <td width="80">
                            <div class='btn-group'>
                                <button type="button" class="btn btn-danger btn-xs btn-delete">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                $('.table tbody').append(row);
            });

            $(document).on('change', '.nama', function(e) {
                e.preventDefault();
                const nama = $(this);
                const id = nama.closest('tr').data('id');
                if (id) {
                    console.log(nama, id);
                    editKriteria({
                        id: id,
                        nama: nama.val()
                    })
                } else {
                    console.log(nama);
                    addKriteria({
                        tr: nama.closest('tr'),
                        nama: nama.val()
                    })
                }
            });
            $(document).on('change', '.kode', function(e) {
                e.preventDefault();
                const kode = $(this);
                const id = kode.closest('tr').data('id');
                if (id) {
                    console.log(kode, id);
                    editKriteria({
                        id: id,
                        kode: kode.val()
                    })
                } else {
                    console.log(kode);
                    addKriteria({
                        tr: kode.closest('tr'),
                        kode: kode.val()
                    })
                }
            });
            $(document).on('change', '.bobot', function(e) {
                e.preventDefault();
                const bobot = $(this);
                const id = bobot.closest('tr').data('id');
                bobot.closest('tr').find('.weight').html(
                    parseInt(bobot.val()) / 100
                )
                if (cekBobot({
                        bobot: parseInt(bobot.val()),
                        tr: bobot.closest('tr')
                    })) {
                    if (id) {
                        console.log(bobot, id);
                        editKriteria({
                            id: id,
                            bobot: bobot.val()
                        })
                    } else {
                        console.log(bobot);
                        addKriteria({
                            tr: bobot.closest('tr'),
                            bobot: bobot.val()
                        })
                    }
                }
            });
            $(document).on('change', '.jenis', function(e) {
                e.preventDefault();
                const jenis = $(this);
                const id = jenis.closest('tr').data('id');
                if (id) {
                    console.log(jenis.val(), id);
                    editKriteria({
                        id: id,
                        jenis: jenis.val()
                    })
                } else {
                    console.log(jenis);
                    addKriteria({
                        tr: jenis.closest('tr'),
                        jenis: jenis.val()
                    })
                }
            });
            $(document).on('change', '.tipe', function(e) {
                e.preventDefault();
                const tipe = $(this);
                const id = tipe.closest('tr').data('id');
                if (id) {
                    console.log(tipe.val(), id);
                    editKriteria({
                        id: id,
                        tipe: tipe.val()
                    })
                } else {
                    console.log(tipe);
                    addKriteria({
                        tr: tipe.closest('tr'),
                        tipe: tipe.val()
                    })
                }
            });
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const btn = $(this);
                const id = btn.closest('tr').data('id');
                console.log(id);
                if (id) {
                    Swal.fire({
                        title: "Are you sure!",
                        icon: 'warning',
                        confirmButtonText: "Yes!",
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: `{{ url('/') }}/kriterias/${id}`,
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    _method: "DELETE"
                                },
                                dataType: "JSON",
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {
                                        btn.closest('tr').remove();
                                        updateNumber();
                                        Swal.fire({
                                            title: "Success!",
                                            icon: 'success',
                                            confirmButtonText: "OK",

                                        }).then(result => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        })
                                    }
                                },
                                error: function(err) {
                                    console.log(err);
                                }
                            });
                        }
                    }).catch((err) => {
                        console.log(err);
                    });

                } else {
                    btn.closest('tr').remove();

                    updateNumber();
                }
            });

            function updateNumber() {
                let totalBobot = 0;
                $('.table tbody tr').each(function(index, el) {
                    $(el).find('td:first').html(index + 1);
                    // chnage bobot
                    totalBobot += parseInt($(el).find('.bobot').val());
                });
                $('tfoot tr th:nth-child(2)').html(totalBobot);
                $('tfoot tr th:nth-child(3)').html(totalBobot / 100);
            }

            function addKriteria({
                tr,
                nama,
                kode,
                bobot,
                jenis,
                tipe
            }) {
                const params = arguments[0];

                for (const key in tempRow) {
                    if (Object.hasOwnProperty.call(tempRow, key)) {
                        if (params[key]) {
                            tempRow[key] = params[key];
                        }
                    }
                }
                console.log(tempRow);
                let tempNullCount = Object.values(tempRow).filter((item) => item == '').length;
                console.log(tempNullCount);
                if (tempNullCount)
                    return false;
                let data = {
                    _token: "{{ csrf_token() }}",
                    ...tempRow
                };
                $.ajax({
                    type: "POST",
                    url: "{{ route('kriterias.store') }}",
                    data,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        $(tr).data('id', response.data.id);
                        tempRow = {
                            nama: '',
                            kode: '',
                            bobot: '',
                            jenis: '',
                            tipe: ''
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

            function editKriteria({
                id,
                nama,
                kode,
                bobot,
                jenis,
                tipe
            }) {
                const params = arguments[0];
                for (const key in params) {
                    if (Object.hasOwnProperty.call(params, key)) {
                        if (key == 'id')
                            continue;
                        const element = params[key];
                        let data = {
                            _token: "{{ csrf_token() }}",
                            _method: "PATCH",
                            ...{
                                [key]: element
                            }
                        };
                        if (element) {
                            $.ajax({
                                type: "PATCH",
                                url: `{{ url('/') }}/kriterias/${id}`,
                                data,
                                dataType: "JSON",
                                success: function(response) {
                                    console.log(response);
                                },
                                error: function(err) {
                                    console.log(err);
                                }
                            });
                        }

                    }
                }
            }

            function cekBobot({
                bobot,
                tr
            }) {
                let totalBobot = {{ $kriterias->sum('bobot') }};
                if (totalBobot + bobot > 100) {
                    Swal.fire({
                        title: "Error!",
                        text: "Total Bobot Melebihi 100",
                        icon: 'error',
                        confirmButtonText: "OK",

                    }).then(result => {
                        if (result.isConfirmed) {
                            tr.find('.bobot').val(0);
                            tr.find('.weight').html(0);
                        }
                    });
                    return false;
                }
                $('tfoot tr th:nth-child(2)').html(totalBobot + bobot);
                $('tfoot tr th:nth-child(3)').html((totalBobot + bobot) / 100);
                return true;
            }
        })
    </script>
@endpush
