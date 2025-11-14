<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'image',
        'featured',
        'stock',
        'sales_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'stock' => 'integer',
        'sales_count' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(6);
            }
        });
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }
}
