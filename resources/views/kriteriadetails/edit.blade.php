@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Kriteria {{ $kriteria->nama }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($kriteriadetail, [
                'route' => ['kriteriadetails.update', ['kriteriaId' => $kriteria->id, 'id' => $kriteriadetail->id]],
                'method' => 'patch',
            ]) !!}

            <div class="card-body">
                <div class="row">
                    @include('kriteriadetails.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('kriteriadetails.index', $kriteria->id) }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
