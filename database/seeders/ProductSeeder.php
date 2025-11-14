<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 sample products
        Product::factory()->count(20)->create();

        // Optional: create some specific feature products
        Product::create([
            'name' => 'Classic Tee',
            'short_description' => 'Comfortable 100% cotton t-shirt.',
            'description' => 'Soft, breathable tee available in multiple colors.',
            'price' => 19.99,
            'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=800&q=80',
            'featured' => true,
            'stock' => 120,
            'sales_count' => 230,
        ]);
    }
}
