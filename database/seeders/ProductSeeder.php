<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['3D Paper Bag', 'Paper', 200, 40],
            ['Bamboo Food Box', 'Bamboo', 350, 25],
            ['Wooden Cutlery Set', 'Wood', 150, 45],
            ['Paper Straws', 'Paper', 120, 50],
            ['Compostable Box', 'Cornstarch', 400, 20],
            ['Jute Carry Bag', 'Jute', 250, 35],
            ['Kraft Paper Shopping Bag', 'Paper', 180, 42],
            ['Bamboo Lunch Container', 'Bamboo', 480, 15],
            ['Birchwood Spoon Pack', 'Wood', 160, 38],
            ['Cornstarch Trash Bags', 'Cornstarch', 300, 30],
            ['Jute Gift Pouch', 'Jute', 140, 28],
            ['Paper Food Tray', 'Paper', 130, 48],
            ['Bamboo Fork and Spoon Set', 'Bamboo', 220, 32],
            ['Wooden Coffee Stirrer Pack', 'Wood', 125, 50],
            ['Cornstarch Clamshell Box', 'Cornstarch', 450, 18],
            ['Jute Wine Bottle Bag', 'Jute', 320, 17],
            ['Paper Soup Container', 'Paper', 275, 24],
            ['Bamboo Straw Set', 'Bamboo', 190, 39],
            ['Wooden Snack Tray', 'Wood', 260, 22],
            ['Compostable Packaging Roll', 'Cornstarch', 500, 12],
        ];

        foreach ($products as [$name, $material, $price, $stock]) {
            $slug = Str::slug($name);

            $product = Product::query()->create([
                'name' => $name,
                'slug' => $slug,
                'description' => "A durable, biodegradable {$material} product designed for everyday sustainable use.",
                'short_description' => "Eco-friendly {$name}.",
                'price' => $price,
                'stock' => $stock,
                'material' => $material,
                'is_active' => true,
            ]);

            $product->images()->createMany([
                [
                    'path' => "products/{$slug}-primary.jpg",
                    'is_primary' => true,
                    'sort_order' => 0,
                ],
                [
                    'path' => "products/{$slug}-detail.jpg",
                    'is_primary' => false,
                    'sort_order' => 1,
                ],
            ]);
        }
    }
}
