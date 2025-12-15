<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Importa el modelo de usuario
use Illuminate\Support\Facades\Hash; // Para la encriptación de la contraseña

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Crear Usuario Principal (Cuenta conocida)
        User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com', // Una cuenta que siempre conozcas
            'password' => Hash::make('password'),
        ]);

        // 2. Crear 9 Usuarios de Prueba con Factory (Total 10)        
        // El método factory() usa el UserFactory.php para generar datos ficticios.
        User::factory()->count(9)->create(); 
        
    }
}
