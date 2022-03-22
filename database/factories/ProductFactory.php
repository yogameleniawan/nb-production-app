<?php

namespace Database\Factories;

use App\Models\Store;
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
            'name' => $this->faker->text(20),
            'image' => $this->faker->imageUrl(640, 460),
            'price' => $this->faker->numberBetween(10000, 50000),
            'store_id' => Store::all()->random()->id,
        ];
    }
}
