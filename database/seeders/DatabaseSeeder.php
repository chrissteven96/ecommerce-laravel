<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ajuste;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Chris SAdmin',
            'email' => 'chris@test.com',
            'password' => bcrypt('12345678'),
        ]);

        Ajuste::create([
            'nombre' => 'ChristoTech',
            'descripcion' => 'ChristoTech Ecommerce',
            'sucursal' => 'Matriz',
            'direccion' => 'Av. Principal 123',
            'telefono' => '123456789',
            'email' => 'info@christotech.com',
            'divisa' => 'USD',
            'pagina_web' => 'https://christotech.com',
            'logo' => 'logos/DicDmhEPKwVzAEjhkSbE7HN2Ml4NiB4oCriyQThF.png',
            'img_login' => 'img_login/mnHWx3K4fdObGZ06SSzfPY9jMsflejS6ulrcjMRN.png',
        ]);

        Role::create([
            'name' => 'SUPER ADMIN',
        ]);
        
        Role::create([
            'name' => 'ADMINISTRADOR',
        ]);
        
        Role::create([
            'name' => 'VENDEDOR',
        ]);
        
        Role::create([
            'name' => 'CLIENTE',
        ]);
        
        Role::create([
            'name' => 'OPERADOR',
        ]);
        
        Role::create([
            'name' => 'INVITADO',
        ]);
    }
}
