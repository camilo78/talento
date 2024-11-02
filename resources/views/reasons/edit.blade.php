@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Editar Razón</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('reasons.update', $reason->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reason" class="form-label">Razón</label>
                            <input type="text" class="form-control" id="reason" name="reason" value="{{ old('reason', $reason->reason) }}">
                            @error('reason')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="proof" class="form-label">Justificación Legal</label>
                            <textarea class="form-control" id="proof" name="proof" rows="4">{{ old('proof', $reason->proof) }}</textarea>
                            @error('proof')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="form-label">Tipo</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Seleccionar</option>
                                <option value="Remunerado" {{ $reason->type == 'Remunerado' ? 'selected' : '' }}>Remunerado</option>
                                <option value="No Remunerado" {{ $reason->type == 'No Remunerado' ? 'selected' : '' }}>No Remunerado</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_days" class="form-label">Máximo de días</label>
                            <input type="number" class="form-control" id="max_days" name="max_days" value="{{ old('max_days', $reason->max_days) }}" min="1">
                            @error('max_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="max_working_days" class="form-label">Máximo de días hábiles</label>
                            <input type="number" class="form-control" id="max_working_days" name="max_working_days" value="{{ old('max_working_days', $reason->max_working_days) }}" min="1">
                            @error('max_working_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mr-2"><i class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
