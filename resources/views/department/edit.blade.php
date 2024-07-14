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
                            <label for="user_id">{{ __('Responsible') }} {{ is_null($department->user) }}</label>
                            <select class="form-control" name="user_id" data-live-search="true">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @if (is_null($department->user)) {{ old('user_id') ? 'selected' : '' }}>
                                    @else
                                    {{ old('user_id', $user->id) == $department->user->id ? 'selected' : '' }}> @endif
                                        {{ $user->fullname }} </option>
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
                            <select class="form-control selectpicker" id="miSelect"
                                title="Ingresa los empleados de esta sala o servicio" multiple data-live-search="true"
                                name="users_m" value="{{ old('users_m') }}">
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
            <div class="col-md-12" id="resultado"></div>

        </div>
    </div>
    <div class="mt-2 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title">Personal Asignado a la sala</h5>
                    <table class="table table-striped table-hover" id="users">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">{{ __('No.') }}</th>
                                <th class="text-center align-middle">{{ __('Full Name') }}</th>
                                <th class="text-center align-middle">{{ __('Email') }}</th>
                                <th class="text-center align-middle">{{ __('DNI') }}</th>
                                <th class="text-center align-middle">{{ __('Functional') }}</th>
                                <th class="text-center align-middle">{{ __('Nominal') }}</th>
                                <th class="text-center align-middle">Tipo de Contratación</th>
                                <th class="text-center align-middle">{{ __('Departamento') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users_d as $user)
                                <tr>
                                    <td class="align-middle small" scope="row">{{ $loop->iteration }}</td>
                                    <td class="align-middle small"><a
                                            href="{{ route('user.show', $user->id) }}">{{ $user->fullname }} </a></td>
                                    <td class="align-middle small"><a
                                            href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                    <td class="align-middle small">{{ $user->dni }}</td>
                                    <td class="align-middle small">{{ $user->functional }}</td>
                                    <td class="align-middle small">{{ $user->nominal }}</td>
                                    <td class="align-middle small">{{ $user->type }}</td>
                                    <td class="align-middle small {{ $user->department->name ?? 'text-warning small' }}">
                                        {{ $user->department->name ?? 'Asignar a una Unidad o Departemento' }} @if ($user->boss == 1)
                                            <span class="badge badge-pill text-white bg-gradient-success pb-1">(@if ($user->gender == 1)
                                                    Jefa
                                                @else
                                                    Jefe
                                                @endif)</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


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
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap4.css">
        <style>
            .h-29 {
                height: 29px;
            }

            table {
                width: 100%;
            }

            .pagination {
                /* Alinear items desde el final */
                justify-content: flex-end !important;
            }
        </style>
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
        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap4.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.bootstrap4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap4.js"></script>
        <script>
            new DataTable('#users', {
                dom: "<'row'<'col-sm-12  col-md-4'B><'col-sm-12 col-md-4 text-center'><'col-sm-12 col-md-4 text-right'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row small'<'col-sm-12 col-md-6'><'col-sm-12 col-md-6'>>",
                drawCallback: function() {
                    $('.form-control').addClass('h-29');
                },
                responsive: true,
                stateSave: true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                buttons: {
                    buttons: [{
                            extend: 'excelHtml5',
                            text: '<i class="fa-regular fa-file-excel"></i> Excel',
                            className: 'btn-sm btn btn-success',
                            title: 'Personal Contratado Hospital General Atlántida',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa-regular fa-file-pdf"></i> Pdf',
                            className: 'btn-sm btn btn-danger',
                            title: 'Personal de {{ $department->name }}',
                            orientation: 'landscape',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            }
                        },
                        {
                            extend: 'colvis',
                            className: 'btn-sm btn btn-info',
                            text: '<i class="fa-regular fa-eye-slash"></i> Visibilidad',
                        },
                    ]
                }
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <script>
            $('select').selectpicker();
            const selectElement = document.getElementById('miSelect');
            const resultadoDiv = document.getElementById('resultado');

            selectElement.addEventListener('change', () => {
                const opcionesSeleccionadas = Array.from(selectElement.selectedOptions).map(option => option
                    .textContent);
                resultadoDiv.innerHTML =
                    `<b>Seleccionaste al siguiente personal para agregarlo a la sala:</b> <br> ${opcionesSeleccionadas.join('<br> ')}`;
            });
        </script>
    @endpush
