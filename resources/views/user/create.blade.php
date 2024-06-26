@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Ingrese los nombres del usuario" autocomplete="off"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" id="last_name" placeholder="Ingrese los apellidos del usuario"
                                autocomplete="off" value="{{ old('last_name') }}">
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Género</label><br>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio"
                                                class="form-check-input @error('gender') border border-warning @enderror"
                                                value="1" {{ old('gender')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}  name="gender"><span
                                                class="@error('gender') text-danger @enderror">Hombre</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="0" {{ old('gender')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} name="gender"><span
                                                class="@error('gender') text-danger @enderror">Mujer</span>
                                        </label>
                                    </div>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Jefe de Unidad o Departamento</label><br>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox"
                                                class="form-check-input @error('boss') border border-warning @enderror"
                                                value="true" {{ old('boss')=="1" ? 'checked='.'"'.'checked'.'"' : '' }} name="boss"><span
                                                class="@error('boss') text-danger @enderror">Es Jefe o Jefa</span>
                                        </label>
                                    </div>
                                    @error('boss')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Ingrese el correo electrónico" autocomplete="off"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dni">{{ __('DNI') }}</label>
                            <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni"
                                id="dni" placeholder="Ingrese su DNI" autocomplete="off" value="{{ old('dni') }}">
                            @error('dni')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="department_id">{{ __('Departamento o Unidad') }}</label>
                            <select class="form-control @error('department_id') is-invalid @enderror"
                                title="Departamento o Unidad" name="department_id" value="{{ old('department_id') }}">
                                @foreach (\App\Models\Department::orderBy('name')->get() as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') ==  $department->id  ? "selected" : " "}}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="functional">{{ __('Functional Charge') }}</label>
                            <input type="text" class="form-control @error('functional') is-invalid @enderror"
                                name="functional" id="functional" placeholder="Ingrese cargo funcional"
                                autocomplete="off" value="{{ old('functional') }}">
                            @error('functional')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nominal">{{ __('Nominal Charge') }}</label>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                name="nominal" id="nominal" placeholder="{{ __('Nominal Charge') }}"
                                autocomplete="off" value="{{ old('nominal') }}">
                            @error('nominal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">{{ __('Tipo de Contratación') }}</label>
                            <select name="type"
                                title="Seleccione Tipo de Contratación"
                                class="form-select form-control @error('type') is-invalid @enderror" aria-label="Default select">
                                <option value="Permanente" {{ old('type') == 'Permanente' ? 'selected' : '' }}>Permanente
                                </option>
                                <option value="Contrato" {{ old('type') == 'Contrato' ? 'selected' : '' }}>Contrato
                                </option>
                                <option value="Interinato" {{ old('type') == 'Interinato' ? 'selected' : '' }}>Interinato
                                </option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="{{ __('Password') }}" autocomplete="off">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                        {{ __('Save') }}</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary mr-2"><i
                            class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                </div>
            </form>
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
