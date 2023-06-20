@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center image-container">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('users/image/' . auth()->user()->image) }}"
                                onerror="this.onerror=null; this.src='{{ asset('img/logo.png') }}'"
                                alt="User profile picture">
                            <button class="btn-circle btn" data-toggle="modal" data-target="#UploadClients"><i
                                    class="fas fa-camera"></i>

                            </button>
                        </div>
                        {{-- <h3 class="profile-username text-center">{{ $user->nama }}</h3>
                        <p class="text-muted text-center">{{ $user->email }}</p>
                        <p class="text-muted text-center "><span
                                class="badge  {{ $user->role->role == 'admin' ? 'badge-success' : 'badge-secondary' }} text-white">{{ $user->role->role }}</span> --}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profile</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'patch']) !!}
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                {!! Form::label('nama', 'Nama :') !!}
                                {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('role_id', 'Role :') !!}
                                {!! Form::select('role_id', ['' => 'Pilih Role'] + $roles->toArray(), null, [
                                    'class' => 'form-control custom-select',
                                ]) !!}
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('email', 'Email :') !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-12">
                                {!! Form::label('password', 'Password :') !!}
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('home') }}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal" id="UploadClients">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Change Photo Profile</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form role="form" action="{{ route('profile.image_update') }}" method="post"
                        enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="container">

                            <div class="col-md-4">
                                <input type="file" class="form-control" placeholder="Enter Nick Name" type="text"
                                    name="image">
                            </div>
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm shadow-sm"><i
                            class="fas fa-check fa-sm text-white-50"></i> Submit</button>
                    <button type="button" class="btn btn-danger btn-sm shadow-sm" data-dismiss="modal"><i
                            class="fas fa-times fa-sm text-white-50"></i> Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('page_css')
    <style>
        .image-container {
            position: relative;
        }

        .image-container .btn {
            position: absolute;
            top: 90%;
            left: 70%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: var(--primary);
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 20px;
        }
    </style>
@endpush
