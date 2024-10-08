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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user_id">Solicitante del Permiso</label>
                            <select class="form-control" id="userSelect" name="user_id" data-live-search="true"
                                title="Selecione un solicitante del permiso">
                                <option value="0" selected>Seleccione un solicitante del permiso</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="departments">Departamento o Sala</label>
                            <input type="text" class="form-control" id="department" placeholder="Departamento o Sala"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Jefe de Departamento o Sala</label>
                            <input type="text" class="form-control" id="jefe" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="beginning">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="beginning" name="beginning" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Fecha de Fin -->
                        <div class="form-group">
                            <label for="end">Fecha de Fin</label>
                            <input type="date" class="form-control" id="end" name="end" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Días de Permiso -->
                        <div class="form-group">
                            <label for="days">Días de Permiso</label>
                            <input type="number" class="form-control" id="days" name="days" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Días de Permiso -->
                        <div class="form-group">
                            <label for="days">Días hábiles de Permiso</label>
                            <input type="number" class="form-control" id="days_h" name="days_h" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="reason">Motivo del Permiso</label>
                            <select class="form-control" id="reason" name="reason" data-live-search="true"
                                title="Selecione un solicitante del permiso">
                                <option value="0" selected>Seleccione un motivo del permiso</option>
                                <optgroup label="Licencias Remuneradas">
                                    @foreach ($reasons_r as $reason)
                                        <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Licencias No Remuneradas">
                                    @foreach ($reasons_n as $reason)
                                        <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
            <div class="alert alert-secondary d-none text-justify mt-2" id="proof-display"></div>
        </div>
    </div>
    <div class="container mt-3 mb-3 shadow" id="contenido-a-imprimir">
        <div class="container-img">
            <img src="{{ asset('img/salud.png') }}" alt="Izquierda" class="img-left">
            <img src="{{ asset('img/hga.png') }}" alt="Derecha" class="img-right">
        </div>
        <div class="header mb-5">
            <h4>HOSPITAL GENERAL ATLÁNTIDA</h4>
            <h5 class="pt-0 pb-0">USO EXCLUSIVO DE </h5>
            <h5 class="pt-0">HOJA DE PERMISO</h5>
        </div>
        <div class="cont1 mb-5">
            <div class="form-group d-flex justify-content-between align-items-center">
                <label for="nombre">NOMBRE:</label>
                <input class="input-print" type="text" id="nombreUsuario" name="nombre" readonly>
            </div>
            <div class="form-group d-flex justify-content-between align-items-center">
                <label for="depto">DEPTO./SALA:</label>
                <input class="input-print" type="text" id="department2" name="depto" readonly>
            </div>
            <div class="form-group d-flex justify-content-between align-items-center">
                <label for="dias">CANTIDAD DE DÍAS:</label>
                <input class="input-print" type="text" id="days2" name="dias" readonly>
            </div>
            <div class="form-group d-flex justify-content-between align-items-center">
                <label for="fecha">DÍAS QUE SOLICITA:</label>
                <input class="input-print" type="text" id="start" name="fecha" readonly>
            </div>
            <div class="form-group d-flex justify-content-between align-items-center">
                <label for="motivo">MOTIVO:</label>
                <div id="myTextarea" class="input-print1" contenteditable="true"></div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-md-12 d-flex justify-content-center mb-5" style="margin-top: 20px">
                    <div class="text-center">
                        <p class="mb-0">________________________</p>
                        <p class="mt-0">Firma del Empleado (a)</p>
                    </div>
                </div>
                <div class="cont col-md-12 d-flex justify-content-between align-items-center" style="margin-top: 10px">
                    <div class="text-center">
                        <p class="mb-0">________________________</p>
                        <p class="mt-0 mb-0">Vo Bo. Jefe de Sala o Depto.</p>
                        <p class="mt-0" id="jefe2"></p>
                    </div>
                    <div class="text-center">
                        <p class="mb-0">________________________</p>
                        <p class="mt-0 mb-0">Vo Bo. <span class="text-truncate" id="department_j"
                                style="width: 10px"></span>
                        </p>
                        <p class="mt-0" id="jefe_j"></p>
                    </div>
                </div>
                <div class=" col-md-12 d-flex justify-content-center mb-5" style="margin-top: 70px">
                    <div class="text-center">
                        <p class="mb-0">__________________________</p>
                        <p class="mt-0 mb-0">Firma del Jefe (a) de RRHH </p>
                        <p class="mt-0">P.M. Aroldo Ortíz</p>
                    </div>
                </div>
                <div class=" cont col-md-12 codigo">
                    <p>AXGRDTH-ENF-001</p>
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
            border: 1px solid #cbd5e0 !important;

        }
        .cont1 {
            padding-left: 100px;
            padding-right: 100px;
        }
        .cont {
            padding-left: 90px;
            padding-right: 90px;
        }

        #contenido-a-imprimir {
            background: #FFF;
            width: 21.59cm;
            /* Ancho */
            height: 27.94cm;
            /* Alto */
            margin: 0 auto;
            /* Centrar en la página */
            padding: 80px 0px;
            /* Espaciado interno */
            border: 1px solid #dedede;
            /* Opcional: borde para visualizar el contenedor */
            box-sizing: border-box;
            /* Asegura que el padding se incluya en el tamaño total */
            font-family: Arial, sans-serif;
            /* Fuente */
            font-size: 12pt;
            /* Tamaño de fuente */
        }

        .container-img {
            position: relative;
        }

        .img-left {
            position: absolute;
            top: 0;
            left: 95px;
            width: 100px;
            /* Ajusta el tamaño de la imagen */
        }

        .img-right {
            position: absolute;
            top: 0;
            right: 95px;
            width: 100px;
            /* Ajusta el tamaño de la imagen */
        }

        .input-print {
            border: none;
            border-bottom: 1px solid #4a5568;
            margin-bottom: 7px;
            color: #4a5568;
            width: 450px !important;
            white-space: pre-wrap !important;
            /* Mantiene los saltos de línea */
        }

        .input-print1 {
            border: none;
            border-bottom: 1px solid #4a5568;
            margin-bottom: 7px;
            color: #4a5568;
            width: 450px !important;
            white-space: pre-wrap !important;
            /* Mantiene los saltos de línea */

        }

        .input-print:focus {
            outline: none;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .codigo {
            text-align: right;
            margin-top: 0px;
        }


        .form-group label {
            display: block;
            font-weight: bold;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar selectpicker
            $('#userSelect, #reason').selectpicker();

            // Función AJAX genérica
            function ajaxRequest(url, successCallback, errorCallback) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: successCallback,
                    error: errorCallback || function() {
                        console.error('Error al realizar la solicitud');
                    }
                });
            }

            // Manejo del select "reason"
            $('#reason').on('change', function() {
                var reasonId = $(this).val();
                if (reasonId) {
                    ajaxRequest('/get-proof/' + reasonId, function(data) {
                        $('#proof-display').removeClass('d-none').html(data.proof);
                        $('#myTextarea').html(data.reason);
                    }, function() {
                        $('#proof-display').html('Error al obtener la justificación.');
                    });
                } else {
                    $('#proof-display').html('');
                }
            });

            // Manejo del select "userSelect"
            $('#userSelect').on('change', function() {
                var userId = $(this).val();
                if (userId) {
                    ajaxRequest('/license/user/' + userId + '/department', function(data) {
                        if (data.department) {
                            $('#department, #department2').val(data.department.name);
                            $('#department_j').html(data.department_j.name);

                            if (data.jefe) {
                                $('#jefe').val(data.jefe.name);
                                $('#jefe2').html(data.jefe.name);
                                $('#jefe_j').html(data.jefe_j.name);
                            } else {
                                $('#jefe').val('No tiene jefe asignado');
                            }
                        } else {
                            $('#department').val('No tiene departamento asignado');
                            $('#jefe').val('');
                        }
                    });
                } else {
                    $('#department, #jefe').val(''); // Limpiar inputs si no hay selección
                }
            });

            // Función para calcular días hábiles excluyendo fines de semana y feriados
            function calcularDiasHabiles(startDate, endDate, feriados) {
                var start = new Date(startDate);
                var end = new Date(endDate);
                var diasHabiles = 0;

                if (start > end) {
                    return 'La fecha de inicio debe ser anterior o igual a la fecha de fin';
                }

                while (start <= end) {
                    var diaSemana = start.getDay();
                    var fechaActual = start.toISOString().split('T')[0]; // Formato 'YYYY-MM-DD'

                    // Si es día hábil y no está en los feriados
                    if (diaSemana >= 1 && diaSemana <= 5 && !feriados.includes(fechaActual)) {
                        diasHabiles++;
                    }
                    start.setDate(start.getDate() + 1);
                }

                return diasHabiles + ' días hábiles';
            }

            // Formatear fecha en "24 de junio de 2024"
            function formatearFecha(fecha) {
                var meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre',
                    'octubre', 'noviembre', 'diciembre'
                ];
                var dia = fecha.getDate();
                var mes = meses[fecha.getMonth()];
                var anio = fecha.getFullYear();
                return `${dia} de ${mes} de ${anio}`;
            }

            // Función para obtener los feriados mediante API
            function obtenerFeriados(callback) {
                $.ajax({
                    url: 'https://calendarific.com/api/v2/holidays',
                    method: 'GET',
                    data: {
                        api_key: 'CNyJkWmMuYPyBO5bbvCXy8Jv4R4qqLzd', // Coloca aquí tu API key de Calendarific
                        country: 'HN', // Código de país para Honduras
                        year: new Date().getFullYear() // Año actual
                    },
                    success: function(response) {
                        var feriados = response.response.holidays; // Obtener la lista de feriados
                        var fechasFeriados = feriados.map(function(holiday) {
                            var fecha = new Date(holiday.date.iso); // Convertir a objeto Date
                            var yyyy = fecha.getFullYear();
                            var mm = ('0' + (fecha.getMonth() + 1)).slice(-
                                2); // Agregar 0 si es necesario
                            var dd = ('0' + fecha.getDate()).slice(-
                                2); // Agregar 0 si es necesario
                            return yyyy + '-' + mm + '-' + dd; // Formato 'YYYY-MM-DD'
                        });

                        // Llamar al callback con los feriados formateados
                        callback(fechasFeriados);
                    },
                    error: function(error) {
                        console.error('Error al obtener feriados:', error);
                        callback([]); // En caso de error, usar lista vacía
                    }
                });
            }

            // Evento para calcular días y mostrar rango de fechas
            $('#beginning, #end').on('change', function() {
                var startDate = $('#beginning').val();
                var endDate = $('#end').val();

                if (startDate && endDate) {
                    obtenerFeriados(function(feriados) {
                        var start = new Date(startDate);
                        var end = new Date(endDate);

                        if (end < start) {
                            alert("La fecha de fin no puede ser anterior a la fecha de inicio.");
                            $('#end, #days').val('');
                            return;
                        }

                        var resultado = calcularDiasHabiles(startDate, endDate, feriados);
                        var diffDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                        var diffDaysText = diffDays + ' días ordinarios, ' + resultado;

                        $('#start').val('Del ' + formatearFecha(start) + ' al ' + formatearFecha(
                            end));
                        $('#days').val(diffDays);
                        $('#days2').val(diffDaysText);
                        console.log(feriados);
                    });
                } else {
                    $('#days').val('');
                }
            });

            // Evento para obtener y mostrar el nombre de usuario seleccionado
            const usuarioSelect = document.getElementById('userSelect');
            usuarioSelect.addEventListener('change', function() {
                nombreUsuario.value = usuarioSelect.options[usuarioSelect.selectedIndex].text;
            });
        });
    </script>
@endpush
