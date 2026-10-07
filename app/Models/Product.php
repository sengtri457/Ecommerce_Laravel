<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'price',
        'sale_price',
        'stock',
        'is_new',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'stock' => 'integer',
            'is_new' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function approvedReviews(): HasMany
    {
        return $this->hasMany(ProductReview::class)->where('is_approved', true);
    }

    /**
     * Primary image URL or path.
     */
    public function getPrimaryImageAttribute(): string
    {
        $primary = $this->images->firstWhere('is_primary', true) ?? $this->images->first();

        return $primary ? $primary->path : 'assets/images/demos/demo-13/products/product-1.jpg';
    }

    /**
     * Effective price after sale discount.
     */
    public function getFinalPriceAttribute(): float
    {
        return (float) (! is_null($this->sale_price) ? $this->sale_price : $this->price);
    }

    /**
     * Check if product is on sale.
     */
    public function getHasDiscountAttribute(): bool
    {
        return ! is_null($this->sale_price) && (float) $this->sale_price < (float) $this->price;
    }

    /**
     * Percentage discount rounded.
     */
    public function getDiscountPercentAttribute(): int
    {
        if (! $this->has_discount || (float) $this->price <= 0) {
            return 0;
        }

        return (int) round((((float) $this->price - (float) $this->sale_price) / (float) $this->price) * 100);
    }

    /**
     * Average rating of approved reviews.
     */
    public function getAverageRatingAttribute(): float
    {
        return (float) ($this->approvedReviews()->avg('rating') ?? 0);
    }

    /**
     * Scope active products.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope featured products.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope newest products.
     */
    public function scopeNewest(Builder $query): Builder
    {
        return $query->latest('id');
    }

    /**
     * Scope products on sale.
     */
    public function scopeOnSale(Builder $query): Builder
    {
        return $query->whereNotNull('sale_price')->whereColumn('sale_price', '<', 'price');
    }
}
