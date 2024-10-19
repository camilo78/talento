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
                        </div>
                        <div class="d-flex flex-row-reverse mt-5">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
