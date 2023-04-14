<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
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
        'name' => $this->faker->word,
        'description' => $this->faker->paragraph(),
        'quantity' => $this->faker->numberBetween(1, 10),
        'status' => $this->faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
        'image' => $this->faker->randomElement(['photo-galaxy-watch.jpeg', 'productphotog-2.jpg', 'three-cosmetic-product.webp']),
        'seller_id' => User::all()->random()->id,
        ];
    }
}
