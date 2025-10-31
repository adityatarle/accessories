<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product image URLs mapped by product name
        $productImages = [
            'Premium Leather Wallet' => [
                'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800',
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800',
                'https://images.unsplash.com/photo-1553481829-2391eba45a17?w=800',
            ],
            'Designer Sunglasses' => [
                'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=800',
                'https://images.unsplash.com/photo-1574252977359-489806ef3047?w=800',
                'https://images.unsplash.com/photo-1611432240842-a3cea3804e1d?w=800',
            ],
            'Luxury Lipstick Set' => [
                'https://images.unsplash.com/photo-1630850867146-2097ca47e82a?w=800',
                'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=800',
                'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=800',
            ],
            'Professional Makeup Brush Set' => [
                'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800',
                'https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?w=800',
                'https://images.unsplash.com/photo-1606376641695-2b93b341af08?w=800',
            ],
            'Elegant Pearl Necklace' => [
                'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=800',
                'https://images.unsplash.com/photo-1603561596112-96632b681094?w=800',
                'https://images.unsplash.com/photo-1611652022419-a9419f74343d?w=800',
            ],
            'Diamond Stud Earrings' => [
                'https://images.unsplash.com/photo-1611652022126-14753ad88edf?w=800',
                'https://images.unsplash.com/photo-1603561596112-96632b681094?w=800',
                'https://images.unsplash.com/photo-1611591437281-b460c4d205b0?w=800',
            ],
            'Designer Handbag' => [
                'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?w=800',
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800',
                'https://images.unsplash.com/photo-1607344645866-009f8e85cc56?w=800',
            ],
            'Crossbody Purse' => [
                'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800',
                'https://images.unsplash.com/photo-1607344645866-009f8e85cc56?w=800',
                'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800',
            ],
            'Luxury Watch' => [
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800',
                'https://images.unsplash.com/photo-1564485377539-4af72d1f6a2f?w=800',
                'https://images.unsplash.com/photo-1522312340680-31f9aba03ece?w=800',
            ],
            'Smart Watch' => [
                'https://images.unsplash.com/photo-1434493789847-2f02dc6ca35d?w=800',
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800',
                'https://images.unsplash.com/photo-1522312340680-31f9aba03ece?w=800',
            ],
        ];

        foreach ($productImages as $productName => $images) {
            $product = Product::where('name', $productName)->first();
            
            if ($product) {
                // Delete existing images for this product
                ProductImage::where('product_id', $product->id)->delete();
                
                foreach ($images as $index => $imageUrl) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $imageUrl,
                        'alt_text' => $product->name . ' - Image ' . ($index + 1),
                        'sort_order' => $index,
                        'is_primary' => $index === 0,
                    ]);
                }
            }
        }
    }
}


