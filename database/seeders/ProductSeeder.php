<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $brands = Brand::all();

        $products = [
            // Accessories
            [
                'name' => 'Premium Leather Wallet',
                'description' => 'Genuine leather wallet with multiple card slots and cash compartment',
                'short_description' => 'Premium leather wallet for everyday use',
                'price' => 2500.00,
                'sale_price' => 1999.00,
                'stock' => 50,
                'category_id' => $categories->where('slug', 'accessories')->first()->id,
                'brand_id' => $brands->where('slug', 'luxury-brand')->first()->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'weight' => 0.2,
                'dimensions' => '10x7x2 cm',
                'attributes' => [
                    'material' => 'Genuine Leather',
                    'color' => 'Brown',
                    'closure' => 'Zipper',
                    'compartments' => 'Multiple'
                ]
            ],
            [
                'name' => 'Designer Sunglasses',
                'description' => 'UV protection sunglasses with polarized lenses and stylish frame',
                'short_description' => 'Stylish sunglasses with UV protection',
                'price' => 3500.00,
                'stock' => 30,
                'category_id' => $categories->where('slug', 'sunglasses')->first()->id,
                'brand_id' => $brands->where('slug', 'style-co')->first()->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'weight' => 0.1,
                'dimensions' => '14x5x3 cm',
                'attributes' => [
                    'lens_type' => 'Polarized',
                    'frame_material' => 'Acetate',
                    'uv_protection' => '100%',
                    'color' => 'Black'
                ]
            ],
            // Cosmetics
            [
                'name' => 'Luxury Lipstick Set',
                'description' => 'Set of 6 premium lipsticks in different shades for all occasions',
                'short_description' => '6-piece luxury lipstick set',
                'price' => 4500.00,
                'sale_price' => 3599.00,
                'stock' => 25,
                'category_id' => $categories->where('slug', 'cosmetics')->first()->id,
                'brand_id' => $brands->where('slug', 'beauty-plus')->first()->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
                'weight' => 0.3,
                'dimensions' => '12x8x3 cm',
                'attributes' => [
                    'finish' => 'Matte',
                    'shades' => 6,
                    'longevity' => '12 hours',
                    'cruelty_free' => true
                ]
            ],
            [
                'name' => 'Professional Makeup Brush Set',
                'description' => 'Complete set of 12 professional makeup brushes for flawless application',
                'short_description' => '12-piece professional brush set',
                'price' => 3200.00,
                'stock' => 40,
                'category_id' => $categories->where('slug', 'cosmetics')->first()->id,
                'brand_id' => $brands->where('slug', 'beauty-plus')->first()->id,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
                'weight' => 0.5,
                'dimensions' => '20x15x5 cm',
                'attributes' => [
                    'bristle_type' => 'Synthetic',
                    'handles' => 'Wooden',
                    'brush_count' => 12,
                    'case_included' => true
                ]
            ],
            // Jewelry
            [
                'name' => 'Elegant Pearl Necklace',
                'description' => 'Beautiful pearl necklace with sterling silver clasp',
                'short_description' => 'Elegant pearl necklace',
                'price' => 8500.00,
                'sale_price' => 6999.00,
                'stock' => 15,
                'category_id' => $categories->where('slug', 'jewelry')->first()->id,
                'brand_id' => $brands->where('slug', 'elegant')->first()->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5,
                'weight' => 0.3,
                'dimensions' => '40x2x1 cm',
                'attributes' => [
                    'material' => 'Freshwater Pearls',
                    'clasp' => 'Sterling Silver',
                    'length' => '40cm',
                    'pearl_size' => '8mm'
                ]
            ],
            [
                'name' => 'Diamond Stud Earrings',
                'description' => 'Classic diamond stud earrings in 14k gold setting',
                'short_description' => 'Diamond stud earrings in gold',
                'price' => 25000.00,
                'stock' => 8,
                'category_id' => $categories->where('slug', 'jewelry')->first()->id,
                'brand_id' => $brands->where('slug', 'elegant')->first()->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
                'weight' => 0.1,
                'dimensions' => '1x1x0.5 cm',
                'attributes' => [
                    'metal' => '14k Gold',
                    'diamond_carat' => '0.25',
                    'clarity' => 'VS1',
                    'cut' => 'Round Brilliant'
                ]
            ],
            // Bags & Purses
            [
                'name' => 'Designer Handbag',
                'description' => 'Luxury handbag made from premium leather with gold hardware',
                'short_description' => 'Luxury leather handbag',
                'price' => 15000.00,
                'sale_price' => 12999.00,
                'stock' => 20,
                'category_id' => $categories->where('slug', 'bags-purses')->first()->id,
                'brand_id' => $brands->where('slug', 'luxury-brand')->first()->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7,
                'weight' => 0.8,
                'dimensions' => '30x20x10 cm',
                'attributes' => [
                    'material' => 'Premium Leather',
                    'hardware' => 'Gold',
                    'style' => 'Tote',
                    'interior_pockets' => 3
                ]
            ],
            [
                'name' => 'Crossbody Purse',
                'description' => 'Compact crossbody purse perfect for evening events',
                'short_description' => 'Elegant crossbody purse',
                'price' => 4500.00,
                'stock' => 35,
                'category_id' => $categories->where('slug', 'bags-purses')->first()->id,
                'brand_id' => $brands->where('slug', 'modern-style')->first()->id,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8,
                'weight' => 0.3,
                'dimensions' => '20x15x5 cm',
                'attributes' => [
                    'material' => 'Satin',
                    'chain_length' => 'Adjustable',
                    'closure' => 'Magnetic',
                    'color' => 'Black'
                ]
            ],
            // Watches
            [
                'name' => 'Luxury Watch',
                'description' => 'Premium automatic watch with leather strap and sapphire crystal',
                'short_description' => 'Luxury automatic watch',
                'price' => 35000.00,
                'sale_price' => 29999.00,
                'stock' => 12,
                'category_id' => $categories->where('slug', 'watches')->first()->id,
                'brand_id' => $brands->where('slug', 'luxury-brand')->first()->id,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 9,
                'weight' => 0.2,
                'dimensions' => '4x4x1 cm',
                'attributes' => [
                    'movement' => 'Automatic',
                    'crystal' => 'Sapphire',
                    'strap' => 'Leather',
                    'water_resistance' => '50m'
                ]
            ],
            [
                'name' => 'Smart Watch',
                'description' => 'Modern smartwatch with fitness tracking and notifications',
                'short_description' => 'Fitness tracking smartwatch',
                'price' => 12000.00,
                'stock' => 25,
                'category_id' => $categories->where('slug', 'watches')->first()->id,
                'brand_id' => $brands->where('slug', 'modern-style')->first()->id,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 10,
                'weight' => 0.3,
                'dimensions' => '4x4x1.5 cm',
                'attributes' => [
                    'display' => 'AMOLED',
                    'battery_life' => '7 days',
                    'fitness_features' => 'Heart rate, GPS',
                    'compatibility' => 'iOS, Android'
                ]
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
