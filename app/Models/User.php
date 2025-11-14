<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product; // <-- make sure Product exists

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * Using the $casts property (standard for Eloquent).
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Products the user has in their wishlist (many-to-many via 'wishlists' table).
     *
     * Make sure you created a 'wishlists' table (migration) or change the table name below.
     */
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wishlists')
                    ->withTimestamps();
    }

    /**
     * Convenience helper to check if a product is in the user's wishlist.
     *
     * Accepts Product model or ID.
     *
     * @param  \App\Models\Product|int  $product
     * @return bool
     */
    public function hasInWishlist($product): bool
    {
        $id = $product instanceof Product ? $product->id : (int) $product;
        return $this->wishlist()->where('product_id', $id)->exists();
    }
}
