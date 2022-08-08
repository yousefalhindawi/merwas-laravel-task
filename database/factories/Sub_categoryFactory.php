<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Sub_categoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_category_name' => $this->faker->sentence(10),
            'sub_category_description' => $this->faker->text(500),
            'sub_category_image' => $this->faker->imageUrl(640,480),
            'category_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
