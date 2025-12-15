<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Router $router): void // <-- Inyectar el Router aquí
    {
    // === Lógica de Spatie - REGISTRO DEL ALIAS ===
    $router->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class); 
    }
    // === AGREGAR ESTE NUEVO MÉTODO ===
    protected function aliasMiddleware(): void
    {
        // Importación necesaria para evitar errores
        $router = $this->app->make(\Illuminate\Routing\Router::class);

        // Registro de los middlewares personalizados (como el de Spatie)
        $router->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
    }
    // ==================================
}

