<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        // create a few sample banners
        Banner::factory()->count(3)->create();

        // optional explicit banner (uses storage/public or public path if you want)
        Banner::create([
            'title' => 'Welcome to E-Store',
            'subtitle' => 'Curated products, fast shipping, and support you can rely on.',
            'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1200&q=80',
            'alt' => 'featured products',
            'cta_text' => 'Shop Now',
            'cta_url' => route('products.index'),
            'active' => true,
            'sort_order' => 0,
        ]);
    }
}
