@extends('adminlte::page')

@section('title', 'Gestión de Usuarios')

@section('content_header')
    <h1>Gestión de Usuarios</h1>
@stop

@section('content')
    {{-- Mostrar mensajes de éxito (si los hay) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    {{-- Usamos la clase 'card' de Bootstrap para contener el contenido --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Usuarios</h3>
        </div>
        <div class="card-body">
            {{-- Incluimos la tabla y el formulario de búsqueda --}}
            @include('users.partials.table')
        </div>
        
        <div class="card-footer">
             {{-- Mover la paginación aquí para que esté en el pie de la tarjeta --}}
             @isset($users)
                 {{ $users->links() }}
             @endisset
        </div>
    </div>
@stop
{{-- La sección 'js' o 'css' se pueden dejar vacías por ahora --}}