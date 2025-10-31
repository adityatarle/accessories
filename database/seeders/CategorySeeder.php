<?php

namespace Database\Seeders;

use App\Models\Category;
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
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Fashion accessories for men and women',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Cosmetics',
                'slug' => 'cosmetics',
                'description' => 'Beauty and cosmetic products',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Jewelry',
                'slug' => 'jewelry',
                'description' => 'Elegant jewelry pieces',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Bags & Purses',
                'slug' => 'bags-purses',
                'description' => 'Handbags, purses, and wallets',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Watches',
                'slug' => 'watches',
                'description' => 'Luxury and casual watches',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Sunglasses',
                'slug' => 'sunglasses',
                'description' => 'Stylish sunglasses and eyewear',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
