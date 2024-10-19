@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">Editar Profesión</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('professions.update', $profession->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profession" class="form-label">Profesión</label>
                            <input type="text" class="form-control" id="profession" name="profession"
                                value="{{ $profession->profession }}" required>
                            @error('profession')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-row-reverse mt-5">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
