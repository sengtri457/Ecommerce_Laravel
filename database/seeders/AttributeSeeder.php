<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Color attribute (Clothes Warm Earth & Neutral Palette)
        $color = Attribute::create([
            'name' => 'Color',
            'slug' => 'color',
            'type' => 'color',
        ]);

        $colors = [
            ['value' => 'Charcoal Black', 'color_code' => '#1A1A1A', 'sort_order' => 1],
            ['value' => 'Warm Canvas White', 'color_code' => '#FAFAF8', 'sort_order' => 2],
            ['value' => 'Terracotta Clay', 'color_code' => '#A35C49', 'sort_order' => 3],
            ['value' => 'Oatmeal Beige', 'color_code' => '#D8D2C2', 'sort_order' => 4],
            ['value' => 'Slate Navy', 'color_code' => '#2C3E50', 'sort_order' => 5],
            ['value' => 'Olive Sage', 'color_code' => '#4B5320', 'sort_order' => 6],
        ];

        foreach ($colors as $c) {
            AttributeValue::create([
                'attribute_id' => $color->id,
                'value' => $c['value'],
                'color_code' => $c['color_code'],
                'sort_order' => $c['sort_order'],
            ]);
        }

        // 2. Size attribute (Standard Apparel Curve)
        $size = Attribute::create([
            'name' => 'Size',
            'slug' => 'size',
            'type' => 'text',
        ]);

        $sizes = [
            ['value' => 'XS', 'sort_order' => 1],
            ['value' => 'S', 'sort_order' => 2],
            ['value' => 'M', 'sort_order' => 3],
            ['value' => 'L', 'sort_order' => 4],
            ['value' => 'XL', 'sort_order' => 5],
            ['value' => 'XXL', 'sort_order' => 6],
        ];

        foreach ($sizes as $s) {
            AttributeValue::create([
                'attribute_id' => $size->id,
                'value' => $s['value'],
                'sort_order' => $s['sort_order'],
            ]);
        }
    }
}
