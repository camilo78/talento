@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    @if (session('message'))
    <div class="alert alert-success border-left-success alert-dismissible fade show">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('department.update', $department->id) }}" method="post">
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">{{ __('Name of Department') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="{{ __('Name') }}" autocomplete="off"
                                value="{{ $department->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">{{ __('Responsible') }} {{ is_null( $department->user)  }}</label>
                            <select class="form-control" name="user_id">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    @if(is_null( $department->user))
                                    {{ old('user_id') ? 'selected' : '' }}>
                                    @else
                                    {{ old('user_id', $user->id) == $department->user->id ? 'selected' : '' }}>
                                    @endif
                                    {{ $user->fullname }}
                                </option>
                            @endforeach
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="users_m">{{ __('Personal de la Sala') }}</label>
                            <select class="form-control selectpicker" id="miSelect" title="Ingresa los empleados de esta sala o servicio" multiple data-live-search="true" name="users_m"
                                value="{{ old('users_m') }}">
                                @foreach ($users_m as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->fullname }}
                                    </option>
                                @endforeach
                            </select>
                            @error('users_m')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                {{ __('Save') }}</button>
                            <a href="{{ route('department.index') }}" class="btn btn-secondary mr-2"><i
                                    class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-2 card">
        <div class="card-body" >
            <div class="row">
            <div class="col-md-6" id="resultado"></div>
            <div class="col-md-6">
                <h5 class="card-title">Personal Asignado a la sala</h5>
                <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center pt-1 pb-1 align-middle" scope="col">#</th>
                        <th class="pt-1 pb-1" scope="col">Nombre</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users_r as $user)
                        <tr>
                            <td class="text-center pt-1 pb-1 align-middle" scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $user->fullname }}</td>
                        </tr>

                       @endforeach
                    </tbody>
                  </table>


            </div>
        </div>
        </div>
    </div>
    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <style>
        .filter-option {
            position: relative !important;
        }

        .btn-light {
            height: 40px !important;
            padding: 4px 8px 4px 6px !important;

        }
    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>
        $('select').selectpicker();
        const selectElement = document.getElementById('miSelect');
        const resultadoDiv = document.getElementById('resultado');

        selectElement.addEventListener('change', () => {
            const opcionesSeleccionadas = Array.from(selectElement.selectedOptions).map(option => option
                .textContent);
            resultadoDiv.innerHTML =
                `<b>Seleccionaste como personal de la sala a:</b> <br> ${opcionesSeleccionadas.join('<br> ')}`;
        });
    </script>
@endpush
