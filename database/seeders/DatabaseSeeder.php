<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ajuste;
use App\Models\Categoria;
use App\Models\Producto;
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

        Role::create(['name' => 'SUPER_ADMIN']);
        Role::create(['name' => 'ADMIN']);
        Role::create(['name' => 'CAJA']);
        Role::create(['name' => 'VENDEDOR']);
        Role::create(['name' => 'CLIENTE']);
        Role::create(['name' => 'TRANSPORTE']);
        Role::create(['name' => 'INVITADO']);

        User::create([
            'name' => 'Chris',
            'email' => 'chris@test.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('SUPER_ADMIN');

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

        Categoria::factory(15)->create();
        Producto::factory(50)->create();

    }
}
