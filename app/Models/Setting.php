<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * In-memory cache for loaded settings in current lifecycle.
     *
     * @var array<string, mixed>|null
     */
    protected static ?array $memoized = null;

    /**
     * Retrieve a setting by key with a fallback default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = static::getAll();

        return $settings[$key] ?? $default;
    }

    /**
     * Retrieve all settings as key-value pairs (memoized).
     *
     * @return array<string, mixed>
     */
    public static function getAll(): array
    {
        if (static::$memoized !== null) {
            return static::$memoized;
        }

        try {
            return static::$memoized = static::pluck('value', 'key')->all();
        } catch (\Throwable) {
            return [];
        }
    }

    /**
     * Clear the in-memory settings cache.
     */
    public static function clearCache(): void
    {
        static::$memoized = null;
    }
}
