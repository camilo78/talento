@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Agregar Nueva Razón</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('reasons.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reason" class="form-label">Razón</label>
                            <input type="text" class="form-control"  value="{{ old('reason') }}" id="reason" name="reason">
                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="proof" class="form-label">Justificación Legal</label>
                            <textarea class="form-control" id="proof" name="proof" rows="4">{{ old('proof') }}</textarea>
                            @error('proof')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="form-label">Tipo</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Seleccionar</option>
                                <option value="Remunerado" {{ old('type') == 'Remunerado' ? 'selected' : '' }}>Remunerado</option>
                                <option value="No Remunerado" {{ old('type') == 'No Remunerado' ? 'selected' : '' }}>No Remunerado</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_days" class="form-label">Máximo de días</label>
                            <input type="number" class="form-control" value="{{ old('max_days') }}" id="max_days" name="max_days" min="1">
                            @error('max_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_working_days" class="form-label">Máximo de días hábiles</label>
                            <input type="number" class="form-control" value="{{ old('max_working_days') }}" id="max_working_days" name="max_working_days" min="1">
                            @error('max_working_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mr-2"><i class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
