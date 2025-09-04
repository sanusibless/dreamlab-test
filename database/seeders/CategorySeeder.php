<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Gender' => ['Male', 'Female', 'Unisex'],
            'Product' => ['Bags', 'Sweaters', 'Glasses', 'Shoes', 'Watches'],
            'Electronics' => ['Phones', 'Laptops', 'Headphones', 'Cameras'],
            'Home & Living' => ['Furniture', 'Decor', 'Kitchenware', 'Lighting'],
            'Beauty & Health' => ['Skincare', 'Makeup', 'Haircare', 'Supplements'],
            'Sports & Outdoors' => ['Fitness', 'Camping', 'Cycling', 'Running'],
        ];

        foreach ($categories as $categoryName => $subCategories) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($subCategories as $subCategoryName) {
                SubCategory::create([
                    'name' => $subCategoryName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
