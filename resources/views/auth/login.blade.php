<x-guest-layout>

    <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="color: #6a0dad; font-size: 24px; font-weight: bold;">Bienvenido</h2>
        <div style="margin-top: 10px; font-size: 40px; color: #8A2BE2;">
            &#9787; 
        </div>
    </div>
    
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Contraseña" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Recordar dispositivo</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center mt-6">
            <button type="submit" style="background-color: #8A2BE2; color: white; padding: 10px 40px; border-radius: 20px; font-weight: bold; border: none; cursor: pointer;">
                Inciar Sesión
            </button>
        </div>
    </form>

</x-guest-layout>