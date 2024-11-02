@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Agregar Nueva Especialidad</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('specialties.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre de la Especialidad</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profession_id">Profesión</label>
                            <select name="profession_id" class="form-control" data-live-search="true">
                                <option value="">Seleccionar Profesión</option>
                                @foreach ($professions as $profession)
                                    <option value="{{ $profession->id }}">{{ $profession->profession }}</option>
                                @endforeach
                            </select>
                            @error('profession_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mr-2"><i class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
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
