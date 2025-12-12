@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario: {{ $user->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modificar Datos</h3>
        </div>
        <div class="card-body">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf 
                @method('PATCH') {{-- MÉTODOS CLAVE --}}

                {{-- NOMBRE (PRECargado) --}}
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- EMAIL (PRECargado) --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- NUEVA CONTRASEÑA (Opcional) --}}
                <div class="form-group">
                    <label for="password">Nueva Contraseña (Dejar vacío para no cambiar)</label>
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- CONFIRMAR CONTRASEÑA --}}
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-pen"></i> Actualizar Usuario
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancelar</a>
            </form>

        </div>
    </div>
@stop