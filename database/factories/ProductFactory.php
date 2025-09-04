<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageUrl = 'https://picsum.photos/640/480?random=' . $this->faker->unique()->numberBetween(1, 10000);

        // Create a unique name for the image
        $imageName = uniqid('product_') . '.jpg';

        // Path inside storage/app/public/products
        $imagePath = 'products/' . $imageName;

        // Download & save image locally
        Storage::disk('public')->put($imagePath, file_get_contents($imageUrl));

        return [
            'name' => $this->faker->word(),        // simple word
            // or a combination // 3 words string
            // 'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 10, 500), // 10.00 - 500.00
            'image' => 'storage/' . $imagePath,
            'rating' => ceil(rand(2, 5)),
            'category_id' => rand(1,3),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Unisex']),
            'sub_category_id' => rand(1, 5)
        ];
    }
}
