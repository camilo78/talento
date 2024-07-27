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
                    <figure class="rounded-circle avatar avatar font-weight-bold"
                        style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ $user->name[0] }}"></figure>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $user->fullName }}</h5>
                                @if ($user->functional != null)
                                <p>{{ $user->functional }}</p>
                                @else
                                <p>{{ $user->nominal }}</p>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $user->fullname }}</h6>
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
                                <b>{{ __('Last Name') }}</b>
                                <p>{{ $user->last_name }}</p>
                            </div>
                            <div class="col-lg-4">
                                <b>{{ __('Email') }}</b>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>{{ __('DNI') }}</b>
                                <p>{{ $user->dni }}</p>
                            </div>
                            <div class="col-lg-4">
                                <b>{{ __('Functional Charge') }}</b>
                                <p>{{ $user->functional }}</p>
                            </div>
                            <div class="col-lg-4">
                                <b>{{ __('Nominal Charge') }}</b>
                                <p>{{ $user->nominal }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <b>{{ __('Type of Contract') }}</b>
                                <p>{{ $user->type }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-end mb-1">
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
