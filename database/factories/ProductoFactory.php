<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
        { 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Precios Base para calculos realistas
        $precio_compra = fake()->randomFloat(2, 10, 500);
        $ganancia = $this->faker->randomElement([0.15,0.20,0.25,0.30,0.35,0.40]);
        $precio_venta = $precio_compra * (1 + $ganancia);

        //Generar codigo unico
        $codigo = 'PRO-'. $this->faker->unique()->numberBetween(1000, 9999);

        $nombresElectronica = [
            'Smartphone Samsung Galaxy' ,
            'Laptop Dell Inspiron',
            'Tablet iPad Air' ,
            'Smart TV 55" 4K', 'Auriculares Inalámbricos', 'Smartwatch Apple' ,
            'Cámara DSLR Canon ',
            'Altavoz Bluetooth JBL', 'Monitor Gaming 27" ',
            'Teclado Mecánico RGB' , 'Mouse Inalámbrico' , 'Impresora Multifuncional'
        ];

        $nombresRopa = [
            'Camiseta Básica Algodón', 'Jeans Slim Fit',
            'Sudadera con Capucha' ,
            'Zapatos Deportivos Running',
            'Chaqueta Denim', 'Vestido Casual' ,
            'Polo Clásico' , 'Shorts Deportivos',
            'Chamarra de Cuero',
            'Falda Plisada', 'Blusa Elegante', 'Traje Formal'
        ];

        $nombresHogar = [
            'Juego de Sábanas' , 'King' , 'Cafetera Programable', 'Licuadora de 8 Velocidades' ,
            'Aspiradora Robot' ,
            'Juego de Ollas Antiadherente',
            'Microondas Digital',
            'Batidora de Mano', 'Tostador de 4 Ranuras ' ,
            'Jarra Eléctrica' ,
            'Set de Cubiertos Acero', 'Olla de Cocción Lenta', 'Freidora de Aire'
            ];

        $nombresDeportes = [
            'Pelota de Fútbol Profesional', 'Raqueta de Tenis' ,
            'Bicicleta de Montaña' ,
            'Mancuernas Ajustables', 'Colchoneta Yoga', 'Cinta para Correr' ,
            'Set de Golf' ,
            'Balón de Baloncesto', 'Pesas Rusas', 'Cuerda para Saltar', 'Bandas de Resistencia', 'Reloj Deportivo'
        ];

    $todosLosNombres = array_merge($nombresElectronica, $nombresRopa, $nombresHogar, $nombresDeportes);
    
    $nombre = $this->faker->randomElement($todosLosNombres);

            return[
                'categoria_id' => Categoria::inRandomOrder()->first()->id ?? Categoria::factory()->create()->id,
                'nombre' => $nombre,
                'slug' => Str::slug($nombre),
                'codigo' => $codigo,
                'descripcion_corta' => $this->faker->sentence(10),
                'descripcion_larga' => $this->faker->paragraphs(3, true),
                'precio_compra' => $precio_compra,
                'precio_venta' => $precio_venta,
                'stock' => $this->faker->numberBetween(0, 100),
                
            ];



}
}
