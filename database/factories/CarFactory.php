<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'make' => $this->faker->company,
            'model' => $this->faker->word,
            'year' => $this->faker->numberBetween(2000, 2023),
            'price' => $this->faker->randomFloat(2, 1000, 50000),
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),        ];
    }
}
