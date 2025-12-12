@extends('adminlte::page')

{{-- 1. Título de la pestaña del navegador --}}
@section('title', 'Mi Dashboard') 

{{-- 2. Título principal en la parte superior del contenido --}}
@section('content_header')
    <h1>Dashboard Principal</h1>
@stop

{{-- 3. Contenido principal de la página --}}
@section('content')
    {{-- Usaremos la clase "card" de Bootstrap que usa AdminLTE para darle un estilo agradable --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Bienvenido!</h3>
        </div>
        <div class="card-body">
            <p>Sesion iniciada correctamente</p>
        </div>
    </div>
@stop

{{-- 4. Opcional: Scripts de JavaScript al final de la página --}}
@section('js')
    <script> console.log('¡AdminLTE cargado!'); </script>
@stop