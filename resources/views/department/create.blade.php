@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('department.store') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $create }}">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('Name of Department') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="{{ __('First Name') }}" autocomplete="off"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{--                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">{{ __('Responsible') }}</label>
                            <select class="form-control selectpicker" data-live-search="true" name="user_id"
                                value="{{ old('user_id') }}">
                                @foreach ($users_r as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->fullname }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
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
                    </div> --}}

                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                {{ __('Save') }}</button>
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mr-2"><i
                                    class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                </div>

        {{--                     <div class="col-md-6" id="resultado">
                    </div> --}}

    </div>
    </form>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <style>
        .filter-option {
            position: relative !important;
        }

        .btn-light {
            height: 40px !important;
            padding: 4px 8px 4px 6px !important;
            border: 1px solid #cbd5e0 !important;

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
