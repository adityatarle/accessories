<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Luxury Brand',
                'slug' => 'luxury-brand',
                'description' => 'Premium luxury accessories and cosmetics',
                'website' => 'https://luxurybrand.com',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Beauty Plus',
                'slug' => 'beauty-plus',
                'description' => 'Professional beauty and cosmetic products',
                'website' => 'https://beautyplus.com',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Style Co',
                'slug' => 'style-co',
                'description' => 'Trendy fashion accessories',
                'website' => 'https://styleco.com',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Elegant',
                'slug' => 'elegant',
                'description' => 'Elegant jewelry and accessories',
                'website' => 'https://elegant.com',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Modern Style',
                'slug' => 'modern-style',
                'description' => 'Modern and contemporary fashion items',
                'website' => 'https://modernstyle.com',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Classic Collection',
                'slug' => 'classic-collection',
                'description' => 'Timeless classic accessories',
                'website' => 'https://classiccollection.com',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
