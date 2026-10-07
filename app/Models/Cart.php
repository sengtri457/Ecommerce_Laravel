<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = [
        'session_token',
        'user_id',
        'coupon_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function subtotal(): float
    {
        return (float) $this->items->sum(fn ($item) => (float) $item->unit_price * (int) $item->quantity);
    }

    public function discount(): float
    {
        if (! $this->coupon) {
            return 0.0;
        }

        return $this->coupon->calculateDiscount($this->subtotal());
    }

    public function total(float $shippingCost = 0.0): float
    {
        $subtotal = $this->subtotal();
        $discount = $this->discount();

        return max(0.0, $subtotal - $discount + $shippingCost);
    }
}
