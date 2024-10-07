@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('User') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    <img class="rounded-circle" src="{{Gravatar::get($user->email, ['size'=>200])}}" alt="{{Auth::user()->name}}">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $user->name }}</h5>
                                @if($user->department)
                                <b>Jefe de {{ $user->department->name }}</b>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-profile-stats">
                                <span class="heading">22</span>
                                <span class="description">Permisos en el mes</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-profile-stats">
                                <span class="heading">10</span>
                                <span class="description">Permisos en el Año</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Departamento</th>
                                        <th>Responsable</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->departments as $department )
                                        <tr>
                                            <td class="small">{{ $department->name }}</td>
                                            <td class="small">{{ $department->user->name ??  '' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $user->name }}</h6>
                </div>
                <div class="card-body">
                    <h6 class="text-primary mb-4"><i class="fa-solid fa-2x fa-circle-info mr-2"></i> {{ __('User information') }}</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <b>{{ __('Name') }}</b>
                                <p>{{ $user->name }}</p>
                            </div>
                            <div class="col-lg-4">
                                <b>Sexo</b>
                                <p>{{ $user->gender == 1  ?  'Hombre' : 'Mujer'}}</p>
                            </div>
                            <div class="col-lg-4">
                                <b>{{ __('Email') }}</b>
                                <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                            </div>
                            <div class="col-lg-4">
                                <b>{{ __('DNI') }}</b>
                                <p>{{ $user->dni }}</p>
                            </div>
                            <div class="col-lg-4">
                                <b>{{ __('RTN') }}</b>
                                <p>{{ $user->rtn }}</p>
                            </div>
                            @if($user->functional)
                            <div class="col-lg-4">
                                <b>{{ __('Functional Charge') }}</b>
                                <p>{{ $user->functional }}</p>
                            </div>
                            @endif
                            @if($user->nominal)
                            <div class="col-lg-4">
                                <b>{{ __('Nominal Charge') }}</b>
                                <p>{{ $user->nominal }}</p>
                            </div>
                            @endif
                            <div class="col-lg-4">
                                <b>{{ __('Type of Contract') }}</b>
                                <p>{{ $user->type }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex flex-row-reverse mb-1">
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary ml-2"><i
                                    class="fa-solid fa-pen-to-square"></i> Editar</a>
                                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary"><i
                                    class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
