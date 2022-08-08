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
            'product_name' => $this->faker->sentence(10),
            'product_description' => $this->faker->text(500),
            'product_image' => $this->faker->imageUrl(640,480),
            'product_price' => $this->faker->numberBetween(1,100),
            'product_quantity' => $this->faker->numberBetween(1,100),
            'category_id' => $this->faker->numberBetween(1,10),
            'sub_category_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
