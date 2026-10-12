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
     * Average rating of approved reviews (N+1 safe).
     */
    public function getAverageRatingAttribute(): float
    {
        if (array_key_exists('average_rating', $this->attributes) && $this->attributes['average_rating'] !== null) {
            return round((float) $this->attributes['average_rating'], 1);
        }

        if ($this->relationLoaded('approvedReviews')) {
            return round((float) ($this->approvedReviews->avg('rating') ?? 0), 1);
        }

        return round((float) ($this->approvedReviews()->avg('rating') ?? 0), 1);
    }

    /**
     * Approved reviews count (N+1 safe).
     */
    public function getReviewsCountAttribute(): int
    {
        if (array_key_exists('reviews_count', $this->attributes)) {
            return (int) $this->attributes['reviews_count'];
        }

        if ($this->relationLoaded('approvedReviews')) {
            return $this->approvedReviews->count();
        }

        return (int) $this->approvedReviews()->count();
    }

    /**
     * Attribute values of type color.
     */
    public function colorAttributes()
    {
        return $this->attributeValues->filter(fn ($val) => $val->attribute?->type === 'color');
    }

    /**
     * Attribute values of non-color types (e.g. sizes, specs).
     */
    public function optionAttributes()
    {
        return $this->attributeValues->filter(fn ($val) => $val->attribute?->type !== 'color');
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

    /**
     * Eager load rating aggregate calculations without N+1.
     */
    public function scopeWithRatingSummary(Builder $query): Builder
    {
        return $query->withAvg(['approvedReviews as average_rating' => fn ($q) => $q->where('is_approved', true)], 'rating')
            ->withCount(['approvedReviews as reviews_count' => fn ($q) => $q->where('is_approved', true)]);
    }

    /**
     * Filter products by request parameters.
     *
     * @param  array<string, mixed>  $filters
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if (! empty($filters['category'])) {
            $category = Category::where('slug', $filters['category'])
                ->orWhere('id', $filters['category'])
                ->first();

            if ($category) {
                $query->whereIn('category_id', $category->allCategoryAndChildrenIds());
            }
        }

        if (! empty($filters['q'])) {
            $term = '%'.trim($filters['q']).'%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                    ->orWhere('sku', 'like', $term)
                    ->orWhere('short_description', 'like', $term);
            });
        }

        if (! empty($filters['brand'])) {
            $brands = (array) $filters['brand'];
            $query->whereHas('brand', fn ($q) => $q->whereIn('slug', $brands));
        }

        if (! empty($filters['attributes'])) {
            $attributeValues = (array) $filters['attributes'];
            $query->whereHas('attributeValues', fn ($q) => $q->whereIn('attribute_values.id', $attributeValues));
        }

        if (! empty($filters['min_price'])) {
            $min = (float) $filters['min_price'];
            $query->where(fn ($q) => $q->where('price', '>=', $min)->orWhere('sale_price', '>=', $min));
        }

        if (! empty($filters['max_price'])) {
            $max = (float) $filters['max_price'];
            $query->where(function ($q) use ($max) {
                $q->where(fn ($sq) => $sq->whereNull('sale_price')->where('price', '<=', $max))
                    ->orWhere(fn ($sq) => $sq->whereNotNull('sale_price')->where('sale_price', '<=', $max));
            });
        }

        if (! empty($filters['sale'])) {
            $query->whereNotNull('sale_price')->whereColumn('sale_price', '<', 'price');
        }

        return $query;
    }

    /**
     * Apply sorting to query.
     */
    public function scopeSort(Builder $query, ?string $sort = 'default'): Builder
    {
        return match ($sort) {
            'newest' => $query->latest('id'),
            'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) ASC'),
            'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) DESC'),
            'name' => $query->orderBy('name', 'asc'),
            'featured' => $query->orderByDesc('is_featured')->latest('id'),
            default => $query->latest('id'),
        };
    }
}
