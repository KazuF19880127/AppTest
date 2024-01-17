<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->realText(10),
           'price' => $this->faker->numberBetween($min = 50, $max = 999),
           'company_id' => $this->faker->numberBetween($min = 1, $max = 3),
           'comment' => $this->faker->realText(50),
           'stock' => $this->faker->numberBetween($min = 10, $max = 30),
           'img_path' => $this->faker->realText(30),
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => null,

          
        ];
    }
}
