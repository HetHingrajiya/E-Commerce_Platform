<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->lexify('????'),
            'short_description' => $this->faker->sentence(8),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 5, 200),
            'image' => 'https://picsum.photos/seed/' . $this->faker->unique()->numberBetween(1, 999) . '/800/800',
            'featured' => $this->faker->boolean(25),
            'stock' => $this->faker->numberBetween(0, 200),
            'sales_count' => $this->faker->numberBetween(0, 500),
        ];
    }
}
