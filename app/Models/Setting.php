<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting by key with fallback default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            $setting = static::where('key', $key)->first();

            return $setting ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Get all settings as key-value pairs.
     *
     * @return array<string, mixed>
     */
    public static function getAll(): array
    {
        try {
            return static::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }
}
