<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombre = $this->faker->unique()->randomElement([
            'Electrónica' ,
            'Ropa y Moda' ,
            'Hogar y Jardín' ,
            'Deportes' ,
            'Juguetes' ,
            'Libros' ,
            'Alimentos y Bebidas' ,
            'Belleza y Cuidado Personal' ,
            'Automóviles' ,
            'Mascotas' ,
            'Música' ,
            'Películas y Series' ,
            'Oficina y Papelería' ,
            'Bebés' ,
            'Salud y Bienestar'
        ]);
        return [
            'nombre' => $nombre,
            'slug' => str($nombre)->slug(),
            'descripcion' => $this->faker->optional(0.6)->sentence(12),
        ];
    }
}
