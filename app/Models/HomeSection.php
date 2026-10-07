<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HomeSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'type', // featured, new, category, on_sale, manual
        'category_id',
        'item_limit',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'item_limit' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'home_section_products')
            ->withPivot('sort_order')
            ->orderBy('home_section_products.sort_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Resolve the products for this section based on its type.
     */
    public function getResolvedProductsAttribute()
    {
        $limit = $this->item_limit ?: 8;

        return match ($this->type) {
            'featured' => Product::active()->featured()->with('images', 'category')->take($limit)->get(),
            'new' => Product::active()->newest()->with('images', 'category')->take($limit)->get(),
            'on_sale' => Product::active()->onSale()->with('images', 'category')->take($limit)->get(),
            'category' => $this->category_id
                ? Product::active()->where('category_id', $this->category_id)->with('images', 'category')->take($limit)->get()
                : Product::active()->with('images', 'category')->take($limit)->get(),
            'manual' => $this->products()->with('images', 'category')->take($limit)->get(),
            default => Product::active()->with('images', 'category')->take($limit)->get(),
        };
    }
}
