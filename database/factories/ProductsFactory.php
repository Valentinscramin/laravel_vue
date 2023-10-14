<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 10, 20),
            'weight' => $this->faker->randomFloat(2, 1, 2),
            'categories_id' => 1,
            'active' => 1,
        ];
    }
}
