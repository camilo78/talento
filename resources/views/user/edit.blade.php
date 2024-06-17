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
            <form action="{{ route('user.update', $user->id) }}" method="post">
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="{{ __('First Name') }}" autocomplete="off"
                                value="{{ old('name') ?? $user->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" id="last_name" placeholder="{{ __('Last Name') }}" autocomplete="off"
                                value="{{ old('last_name') ?? $user->last_name }}">
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="{{ __('Email') }}" autocomplete="off"
                                value="{{ old('email') ?? $user->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dni">{{ __('DNI') }}</label>
                            <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni"
                                id="dni" placeholder="{{ __('DNI') }}" autocomplete="off"
                                value="{{ old('dni') ?? $user->dni }}">
                            @error('dni')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ __('Department') }}</label>
                            <select class="form-control" name="user_id" value="{{ old('user_id') }}">
                                @foreach (\App\Models\Department::orderBy('name')->get() as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="functional">{{ __('Functional Charge') }}</label>
                            <input type="text" class="form-control @error('functional') is-invalid @enderror"
                                name="functional" id="functional" placeholder="{{ __('Functional Charge') }}" autocomplete="off"
                                value="{{ old('functional') ?? $user->functional }}">
                            @error('functional')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nominal">{{ __('Nominal Charge') }}</label>
                            <input type="text" class="form-control @error('nominal') is-invalid @enderror"
                                name="nominal" id="nominal" placeholder="{{ __('Nominal Charge') }}" autocomplete="off"
                                value="{{ old('nominal') ?? $user->nominal }}">
                            @error('nominal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">{{ __('Tipo de Contratación') }}</label>
                            <select name="type" class="form-select form-control" aria-label="Default select">
                                <option selected>{{ $user->type }}</option>
                                @if ( $user->type != "Permanente")
                                <option value="Permanente">Permanente</option>
                                @endif
                                @if($user->type != "Contrato")
                                <option value="Contrato">Contrato</option>
                                @endif
                                @if($user->type != "Interinato")
                                <option value="Interinato">Interinato</option>
                                @endif
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="{{ __('Password') }}" autocomplete="off">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary ml-2"><i class="fa-solid fa-floppy-disk"></i>
                        {{ __('Save') }}</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary"><i
                            class="fa-solid fa-arrow-left"></i> {{ __('Back') }}</a>
                </div>
            </form>
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
