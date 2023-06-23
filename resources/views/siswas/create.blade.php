@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Siswa</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'siswas.store', 'files' => true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('siswas.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('siswas.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $(function() {
            $('input[name="nis"]').val({!! json_encode($nis) !!});
            $('#form_nisn').hide();
            //     $('input[name="foto"]').filepond({
            //         labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
            //         storeAsFile: true,
            //         imagePreviewMaxHeight: 150,
            //         imagePreviewTransparencyIndicator: 'grid',
            //         acceptedFileTypes: ['image/*'],
            //         fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
            //             resolve(type);
            //         }),
            //     });
        })
    </script>
@endpush
