<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class WishlistItem extends Model
{
    protected $fillable = [
        'session_token',
        'user_id',
        'product_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope items belonging to the current user or guest session.
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
}
