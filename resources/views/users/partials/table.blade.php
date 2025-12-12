{{-- 1. Cabecera con Búsqueda y Botón Crear --}}
{{-- Usamos d-flex, justify-content-between y align-items-center para que se vean bien --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    
    {{-- FORMULARIO DE BÚSQUEDA --}}
    <form action="{{ route('users.index') }}" method="GET" class="w-50">
        <div class="input-group input-group-sm">
            <input 
                type="text" 
                name="search" 
                placeholder="Buscar por nombre o email..."
                value="{{ $search ?? '' }}"
                class="form-control" {{-- Clase de input de Bootstrap --}}
            >
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
            
            @if (isset($search) && $search)
                <div class="input-group-append ml-2">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        Limpiar
                    </a>
                </div>
            @endif
        </div>
    </form>
    
    {{-- BOTÓN DE CREAR USUARIO --}}
    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Crear Nuevo Usuario
    </a>
</div>

{{-- 2. La Tabla --}}
<div class="table-responsive">
    <table class="table table-bordered table-striped"> {{-- Clases de Bootstrap para tablas --}}
        <thead>
            <tr>
                <th style="width: 10px">ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Registro</th>
                <th style="width: 150px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        {{-- Botón de Editar --}}
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        {{-- Botón de Eliminar (Formulario POST) --}}
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar a este usuario?')">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
