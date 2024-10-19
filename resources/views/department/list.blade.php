@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<h1 class="h3 text-gray-800">{{ __($title) ?? __('Blank Page') }}</h1>
<table class="table table table-striped table-bordered bg-white shadow mt-1" id="department">
    <thead>
        <tr>
            <th class="text-center pt-1 pb-1 align-middle">{{ __('No.') }}</th>
            <th class="text-center pt-1 pb-1 align-middle">{{ __('Name of Deparatament') }}</th>
            <th class="text-center pt-1 pb-1 align-middle">Departamento Padre</th>
            <th class="text-center pt-1 pb-1 align-middle">{{ __('Responsible') }}</th>
            <th class="text-center pt-1 pb-1 align-middle">Personal</th>
            <th class="text-center pt-1 pb-1 align-middle">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
        <tr>
            <td class="text-center pt-1 pb-1 align-middle" scope="row">{{ $loop->iteration }}</td>
            <td class="pt-1 pb-1 align-middle">{{ $department->name }}</td>
            <td class="pt-1 pb-1 align-middle">{{ $department->parent->name ?? 'Sin departamento Padre' }}</td>
            <td class="pt-1 pb-1 align-middle">{{$department->user()->pluck('name')->first()}}</td>
            <td class="pt-1 pb-1 align-middle text-center">{{ App\Models\User::whereHas('departments', function ($query) use ($department) {$query->where('department_id', $department->id);})->count(),}}</td>
            <td class="pt-1 pb-1 align-middle">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('department.edit', $department->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ route('department.destroy', $department->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true"><i class="fa-solid fa-trash"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- End of Main Content -->
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
    new DataTable('#department', {
        lengthMenu: [25, 50, 75, 100]
        , dom: "<'row'<'col-sm-12  col-md-4'B><'col-sm-12 col-md-4 text-center'l><'col-sm-12 col-md-4 text-right'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row small'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>"
        , drawCallback: function() {
            $('.form-control').addClass('h-29');
        }
        , responsive: true
        , stateSave: true
        , language: {
            "sProcessing": "Procesando..."
            , "sLengthMenu": "Mostrar _MENU_ registros"
            , "sZeroRecords": "No se encontraron resultados"
            , "sEmptyTable": "Ningún dato disponible en esta tabla"
            , "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros"
            , "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros"
            , "sInfoFiltered": "(filtrado de un total de _MAX_ registros)"
            , "sInfoPostFix": ""
            , "sSearch": "Buscar:"
            , "sUrl": ""
            , "sInfoThousands": ","
            , "sLoadingRecords": "Cargando..."
            , "oPaginate": {
                "sFirst": "Primero"
                , "sLast": "Último"
                , "sNext": "Siguiente"
                , "sPrevious": "Anterior"
            }
            , "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente"
                , "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
        , buttons: {
            buttons: [{
                    extend: 'excelHtml5'
                    , text: '<i class="fa-regular fa-file-excel"></i> Excel'
                    , className: 'btn-sm btn btn-success'
                    , title: 'Personal Contratado Hospital General Atlántida'
                    , exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
                , {
                    extend: 'pdfHtml5'
                    , text: '<i class="fa-regular fa-file-pdf"></i> Pdf'
                    , className: 'btn-sm btn btn-danger'
                    , title: 'Personal Contratado Hospital General Atlántida'
                    , customize: function(doc) {
                        var colCount = doc.content[1].table.body[0].length;
                        for (i = 0; i < doc.content[1].table.body.length; i++) {
                            doc.content[1].table.body[i][4].alignment = 'center'; // Columna 4 centrada (índice 3)
                        }
                    }
                    , exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
                , {
                    extend: 'colvis'
                    , className: 'btn-sm btn btn-info'
                    , text: '<i class="fa-regular fa-eye-slash"></i> Visibilidad'
                , }
                , {
                    className: 'btn-sm btn btn-primary'
                    , text: '<i class="fa-solid fa-user-plus"></i> Nuevo'
                    , action: function(e, dt, button, config) {
                        window.location = '{{ route('department.create') }}';
                    }

                }
            ]
        , }

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
