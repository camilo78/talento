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
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombres</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Ingrese los nombres del usuario" autocomplete="off"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="Ingrese el correo electrónico" autocomplete="off"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dni">{{ __('DNI') }}</label>
                            <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni"
                                id="dni" placeholder="Ingrese su DNI" autocomplete="off"
                                value="{{ old('dni', $user->dni) }}">
                            @error('dni')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rtn">{{ __('RTN') }}</label>
                            <input type="text" class="form-control @error('rtn') is-invalid @enderror" name="rtn"
                                id="rtn" placeholder="Ingrese su RTN" autocomplete="off"
                                value="{{ old('rtn', $user->rtn) }}">
                            @error('rtn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="department_id">{{ __('Departamento o Unidad') }}</label>
                            <select class="form-control @error('department_id') is-invalid @enderror" data-live-search="true"
                                title="Departamento o Unidad" name="department_id" value="{{ old('department_id') }}">
                                @foreach (\App\Models\Department::orderBy('name')->get() as $department)
                                @if($user->departments->first() == Null)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : ' ' }}>
                                    {{ $department->name }}
                                </option>
                                @else
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $user->departments->first()->id ) == $department->id ? 'selected' : ' ' }}>
                                    {{ $department->name }}
                                </option>
                                @endif

                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="profession_id">{{ __('Profesión') }}</label>
                            <select class="form-control @error('profession_id') is-invalid @enderror" data-live-search="true"
                                title="Selecciona una profesión" name="profession_id" value="{{ old('profession_id', $user->profession_id) }}">
                                @foreach (\App\Models\Profession::orderBy('profession')->get() as $profession)
                                    <option value="{{ $profession->id }}"
                                        {{ old('profession_id', $user->profession_id) == $profession->id ? 'selected' : '' }}>
                                        {{ $profession->profession }}
                                        @if ($profession->specialty)
                                            con Especialidad en {{ $profession->specialty }}
                                        @elseif ($profession->other_studies)
                                            , {{ $profession->other_studies }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('profession_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Género</label><br>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input @error('gender') border border-warning @enderror"
                                        value="1"
                                        {{ old('gender', $user->gender) == '1' ? 'checked=' . '"' . 'checked' . '"' : '' }}
                                        name="gender"><span class="@error('gender') text-danger @enderror">Hombre</span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio"
                                        class="form-check-input @error('gender') border border-warning @enderror"
                                        value="0"
                                        {{ old('gender', $user->gender) == '0' ? 'checked=' . '"' . 'checked' . '"' : '' }}
                                        name="gender"><span class="@error('gender') text-danger @enderror">Mujer</span>
                                </label>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="functional">{{ __('Functional Charge') }}</label>
                            <input type="text" class="form-control @error('functional') is-invalid @enderror"
                                name="functional" id="functional" placeholder="Ingrese cargo funcional" autocomplete="off"
                                value="{{ old('functional', $user->functional) }}">
                            @error('functional')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nominal">{{ __('Nominal Charge') }}</label>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                name="nominal" id="nominal" placeholder="{{ __('Nominal Charge') }}" autocomplete="off"
                                value="{{ old('nominal', $user->nominal) }}">
                            @error('nominal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">{{ __('Tipo de Contratación') }}</label>
                            <select name="type" title="Seleccione Tipo de Contratación"
                                class="form-select form-control @error('type') is-invalid @enderror"
                                aria-label="Default select">
                                <option value="Permanente"
                                    {{ old('type', $user->type) == 'Permanente' ? 'selected' : '' }}>Permanente
                                </option>
                                <option value="Contrato" {{ old('type', $user->type) == 'Contrato' ? 'selected' : '' }}>
                                    Contrato
                                </option>
                                <option value="Interinato"
                                    {{ old('type', $user->type) == 'Interinato' ? 'selected' : '' }}>Interinato
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
                        <div class="d-flex flex-row-reverse mt-5">
                            <button type="submit" class="btn btn-primary ml-2"><i class="fa-solid fa-floppy-disk"></i>
                                {{ __('Save') }}</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
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
            border: 1px solid #cbd5e0 !important;

        }
    </style>
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js" integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>
        $('select').selectpicker();
        $('#dni').inputmask('9999-9999-99999', {
                // La máscara aparecerá en el input, pero no será enviada en la petición
                removeMaskOnSubmit: true
            });
            $('#rtn').inputmask('9999-9999-99999-9', {
                // La máscara aparecerá en el input, pero no será enviada en la petición
                removeMaskOnSubmit: true
            });

    </script>
@endpush
