<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => $this->faker->sentence(10),
            'category_description' => $this->faker->text(500),
            'category_image' => $this->faker->imageUrl(640,480),
        ];
    }
}
