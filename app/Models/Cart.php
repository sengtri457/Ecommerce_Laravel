<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Scope query to the current session or authenticated user.
     */
    public function scopeForCurrentSession(Builder $query): Builder
    {
        $token = get_cart_session_token();
        $userId = Auth::id();

        return $query->where(function ($q) use ($token, $userId) {
            if ($userId) {
                $q->where('user_id', $userId)->orWhere('session_token', $token);
            } else {
                $q->where('session_token', $token);
            }
        });
    }

    /**
     * Retrieve the active cart for the current visitor.
     */
    public static function current(): ?static
    {
        return static::forCurrentSession()->first();
    }

    /**
     * Retrieve or instantiate the active cart for current visitor.
     */
    public static function currentOrCreate(): static
    {
        $cart = static::current();

        if (! $cart) {
            $cart = static::create([
                'session_token' => get_cart_session_token(),
                'user_id' => Auth::id(),
            ]);
        } elseif (Auth::check() && ! $cart->user_id) {
            $cart->update(['user_id' => Auth::id()]);
        }

        return $cart;
    }
}
