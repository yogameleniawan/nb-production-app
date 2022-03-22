<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
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
            'address' => $this->faker->address(),
            'image' => $this->faker->imageUrl(640, 460),
            'slug' => Str::slug($this->faker->text(20)),
        ];
    }
}
