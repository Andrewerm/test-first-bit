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
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->randomNumber(5, true),
            'color' => $this->faker->safeColorName(),
            'price' => $this->faker->randomNumber(5, true),
            'size' => $this->faker->word(),
            'description' => $this->faker->words(5,true),
        ];
    }
}
