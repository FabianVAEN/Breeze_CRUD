<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenida - {{ config('app.name', 'Mi Proyecto') }}</title>
    
    <style>
        /* 1. ESTILO GLOBAL Y FONDO DEGRADADO OSCURO */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            /* Fondo: Un degradado oscuro (similar al diseño que me mostraste) */
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: white; /* Texto blanco para el fondo oscuro */
        }
        
        /* 2. ESTILO DE LA TARJETA TRANSPARENTE (Glassmorphism) */
        .content {
            text-align: center;
            padding: 60px;
            width: 90%;
            max-width: 600px;
            /* Propiedades Glassmorphism */
            background: rgba(255, 255, 255, 0.1); /* Fondo blanco muy transparente */
            backdrop-filter: blur(10px); /* Desenfoque del fondo */
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3); /* Marco contrastante */
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        
        /* 3. ESTILO DE BOTONES */
        .links {
            margin-top: 30px;
        }
        .links a {
            /* Estilo base del botón */
            display: inline-block;
            padding: 10px 25px;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.1s;
        }
        
        /* Botón de LOGIN/Iniciar Sesión */
        .btn-login {
            background-color: #6a0dad; /* Púrpura oscuro */
            color: white;
            border: 2px solid #9d65c9; /* Marco contrastante */
        }
        .btn-login:hover {
            background-color: #9d65c9;
            transform: translateY(-2px);
        }

        /* Botón de REGISTRO */
        .btn-register {
            background-color: transparent; /* Transparente */
            color: #fff;
            border: 2px solid #fff; /* Marco contrastante blanco */
        }
        .btn-register:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 style="font-size: 36px; margin-bottom: 10px;">{{ config('app.name', 'Mi Proyecto') }}</h1>
        <p style="opacity: 0.8;">Sistema de Gestión Administrativa de Usuarios.</p>
        
        <div class="links">
            @if (Route::has('login'))
                @auth
                    {{-- Si ya está logeado, va al dashboard --}}
                    <a href="{{ url('/dashboard') }}" class="btn-login">
                        Ir al Dashboard
                    </a>
                @else
                    {{-- Si no está logeado, ofrece login y registro --}}
                    <a href="{{ route('login') }}" class="btn-login">
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-register">
                            Registrarse
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>