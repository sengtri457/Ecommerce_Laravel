<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Color attribute
        $color = Attribute::create([
            'name' => 'Color',
            'slug' => 'color',
            'type' => 'color',
        ]);

        $colors = [
            ['value' => 'Black', 'color_code' => '#333333', 'sort_order' => 1],
            ['value' => 'White', 'color_code' => '#ffffff', 'sort_order' => 2],
            ['value' => 'Blue', 'color_code' => '#3399cc', 'sort_order' => 3],
            ['value' => 'Red', 'color_code' => '#cc3333', 'sort_order' => 4],
            ['value' => 'Gold', 'color_code' => '#f2a900', 'sort_order' => 5],
        ];

        foreach ($colors as $c) {
            AttributeValue::create([
                'attribute_id' => $color->id,
                'value' => $c['value'],
                'color_code' => $c['color_code'],
                'sort_order' => $c['sort_order'],
            ]);
        }

        // 2. Size attribute
        $size = Attribute::create([
            'name' => 'Size',
            'slug' => 'size',
            'type' => 'text',
        ]);

        $sizes = [
            ['value' => 'Small', 'sort_order' => 1],
            ['value' => 'Medium', 'sort_order' => 2],
            ['value' => 'Large', 'sort_order' => 3],
            ['value' => 'Extra Large', 'sort_order' => 4],
        ];

        foreach ($sizes as $s) {
            AttributeValue::create([
                'attribute_id' => $size->id,
                'value' => $s['value'],
                'sort_order' => $s['sort_order'],
            ]);
        }

        // 3. Storage attribute
        $storage = Attribute::create([
            'name' => 'Storage',
            'slug' => 'storage',
            'type' => 'text',
        ]);

        $storages = [
            ['value' => '64GB', 'sort_order' => 1],
            ['value' => '128GB', 'sort_order' => 2],
            ['value' => '256GB', 'sort_order' => 3],
            ['value' => '512GB', 'sort_order' => 4],
        ];

        foreach ($storages as $st) {
            AttributeValue::create([
                'attribute_id' => $storage->id,
                'value' => $st['value'],
                'sort_order' => $st['sort_order'],
            ]);
        }
    }
}
