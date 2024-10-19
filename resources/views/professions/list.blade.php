@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <h1 class="h3 text-gray-800">Profesiones</h1>
    <table class="table table-striped table-bordered border-primary bg-white shadow mt-1 w-100" id="professions">
        <thead>
            <tr>
                <th class="text-center pt-1 pb-1 align-middle">ID</th>
                <th class="text-center pt-1 pb-1 align-middle">Profesión</th>
                <th class="text-center pt-1 pb-1 align-middle">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($professions as $profession)
            <tr>
                <td class="text-center pt-1 pb-1 align-middle small" scope="row">{{ $loop->iteration }}</td>
                <td class="pt-1 pb-1 align-middle small">{{ $profession->profession }}</td>
                <td class="pt-1 pb-1 align-middle">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('professions.edit', $profession->id) }}" class="btn btn-sm btn-primary mr-2"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{ route('professions.destroy', $profession->id) }}" class="btn btn-sm btn-danger"
                            data-confirm-delete="true"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
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
        new DataTable('#professions', {
            lengthMenu: [25, 50, 75, 100],
            dom: "<'row'<'col-sm-12  col-md-4'B><'col-sm-12 col-md-4 text-center'l><'col-sm-12 col-md-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row '<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            drawCallback: function() {
                $('.form-control').addClass('h-29');
            },
            responsive: true,  // Hace que la tabla sea responsive
        columnDefs: [
            { responsivePriority: 1, targets: -1 }  // Fija la primera columna como siempre visible
        ],
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
                buttons: [
                    {
                        className: 'btn-sm btn btn-primary',
                        text: '<i class="fa-solid fa-user-graduate"></i> Nuevo',
                        action: function(e, dt, button, config) {
                            window.location = '{{ route('professions.create') }}';
                        }
                    }
                ]
            }
        });
    </script>
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

        .ancho {
            width: 100%;
        }
    </style>
@endpush
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

