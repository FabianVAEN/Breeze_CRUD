<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    {{-- MENSAJES DE ERROR DE VALIDACIÓN (Si usas el mismo código del create.blade.php) --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- 1. Formulario que apunta al método update y usa PATCH --}}
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf 
                        @method('PATCH') {{-- ¡NECESARIO! Simula el método PATCH --}}

                        {{-- NOMBRE --}}
                        <div class="mt-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nombre</label>
                            {{-- 2. PRECÁRGA DE VALOR ACTUAL --}}
                            <input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                        </div>

                        {{-- EMAIL --}}
                        <div class="mt-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                        </div>

                        {{-- CONTRASEÑA (Dejar vacío, solo para cambiar) --}}
                        <div class="mt-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">Nueva Contraseña (Dejar vacío para no cambiar)</label>
                            <input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password" autocomplete="new-password" />
                        </div>

                        {{-- CONFIRMAR CONTRASEÑA --}}
                        <div class="mt-4">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmar Nueva Contraseña</label>
                            <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password_confirmation" />
                        </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-gray-400 uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Actualizar Usuario') }} 
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>