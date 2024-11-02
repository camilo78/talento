@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Agregar Nueva Profesión</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('professions.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profession" class="form-label">Profesión</label>
                            <input type="text" class="form-control" id="profession" name="profession" required>
                            @error('profession')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-row-reverse mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                Guardar</button>
                            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary mr-2"><i
                                    class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
