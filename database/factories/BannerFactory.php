<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Banner;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner> */
class BannerFactory extends Factory
{
    protected $model = Banner::class;

    public function definition()
    {
        $title = $this->faker->sentence(3);
        $imgSeed = $this->faker->unique()->numberBetween(1, 1000);
        return [
            'title' => $title,
            'subtitle' => $this->faker->sentence(8),
            // using picsum for example images; replace with asset(...) if using local files
            'image' => 'https://picsum.photos/seed/banner' . $imgSeed . '/1200/800',
            'alt' => $title,
            'cta_text' => $this->faker->randomElement(['Shop Now', 'Explore', 'Learn More']),
            'cta_url' => '/products',
            'active' => true,
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
