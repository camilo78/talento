@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('license.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">Solicitante del Permiso</label>
                            <select class="form-control" id='user_id' name="user_id" data-live-search="true" title="Selecione un solicitante del permiso">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @if (is_null($users)) {{ old('user_id') ? 'selected' : '' }}>
                                    @else
                                    {{ old('user_id', $user->id) ? 'selected' : '' }}> @endif
                                        {{ $user->name }} </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="departments">Departamento o Sala</label>
                            <select class="form-control custom-select" id="department_select">
                                <option value="" disabled selected>Selecione un solicitante del permiso</option>
                                <!-- Opciones de departamentos -->
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">

                        <div class="form-group">
                            <label for="name">Jefe de Departamento o Sala</label>
                            <input type="text" class="form-control" id="user_name" readonly>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                {{ __('Save') }}</button>
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mr-2"><i
                                    class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
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
        $('#user_id').selectpicker();

        $('#user_id').change(function() {
            var userId = $(this).val();

            $.ajax({
                url: '/get-departments', // Ruta a tu controlador para obtener los departamentos
                type: 'GET',
                data: {
                    user_id: userId
                },
                success: function(response) {
                    var departmentSelect = $('#department_select');
                    departmentSelect.empty();
                    $.each(response.departments, function(key, value) {
                        departmentSelect.append("<option value='" + value.id + "'>" + value
                            .name + "</option>");
                        loadUser();
                    });
                },
                error: function() {
                    console.log('Error al obtener los departamentos.');
                }
            });
        });
        $(document).ready(function () {
            loadUser();
        });
        // Al cambiar la selección del campo
        $('#department_select').change(function() {
            loadUser();
        });

        $('#department_id').focus(function () {
            loadUser();
        });

        $(document).ready(function () {
            loadUser();
        });

        function loadUser() {
            var departmentId = $('#department_select').val();

            $.ajax({
                url: '/get-user', // Ruta a tu controlador para obtener el usuario
                type: 'GET',
                data: {
                    department_id: departmentId
                },
                success: function(response) {
                    $('#user_name').val(response.user_name);
                },
                error: function() {
                    console.log('Error al obtener el usuario.');
                }
            });
        }

    </script>
@endpush
