<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->firstName,
            'description' => $faker->realText,
            'price' => $faker->randomFloat('2', 8, 2),

        ];
    }
}
