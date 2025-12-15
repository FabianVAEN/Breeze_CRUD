<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Necesario para encontrar y asignar el rol al usuario
use Spatie\Permission\Models\Role; // Clase para Roles de Spatie
use Spatie\Permission\Models\Permission; // Clase para Permisos de Spatie

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiar la caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. CREACIÓN DE PERMISOS (Las "habilidades" específicas)
        
        // Permisos relacionados con posts
        Permission::create(['name' => 'crear_posts']);
        Permission::create(['name' => 'editar_posts']);
        Permission::create(['name' => 'eliminar_posts']);

        // Permisos relacionados con reportes o administración
        Permission::create(['name' => 'ver_dashboard_admin']);
        Permission::create(['name' => 'ver_reportes_financieros']);
        
        // 2. CREACIÓN DE ROLES (Las "etiquetas" que agrupan habilidades)

        $adminRole = Role::create(['name' => 'administrador']);
        $editorRole = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'usuario']);
        
        // 3. ASIGNACIÓN DE PERMISOS A ROLES

        // Rol Administrador: Tiene todos los permisos creados
        // Usamos where('name', '!=', 'usuario') para obtener todos los permisos (si hay más).
        $adminRole->givePermissionTo(Permission::all()); 

        // Rol Editor: Solo puede crear y editar posts, y ver el dashboard
        $editorRole->givePermissionTo([
            'crear_posts',
            'editar_posts',
            'ver_dashboard_admin',
        ]);
        
        // Rol Usuario: Por defecto no tiene permisos especiales de administración

        // 4. ASIGNACIÓN DE ROLES A USUARIOS CLAVE
        // A. Buscar el usuario clave que creamos en UserSeeder ('admin@test.com')
        $adminUser = User::where('email', 'admin@test.com')->first();
        
        if ($adminUser) {
            // Asignar el rol de 'administrador' a ese usuario
            $adminUser->assignRole('administrador');
            
        }

        // B. Crear un nuevo usuario 'editor' para pruebas
        $editorUser = User::where('email', 'editor@test.com')->first(); 
        
        if (!$editorUser) {
            $editorUser = User::create([
                'name' => 'Editor Test',
                'email' => 'editor@test.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]);
        }
        $editorUser->assignRole('editor');
    }
}