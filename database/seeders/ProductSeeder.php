<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Beras Ramos Premium 5kg',
                'description' => 'Beras putih pulen kualitas premium kemasan 5 kilogram untuk kebutuhan warung dan rumah tangga.',
                'price' => 74500,
                'stock' => 45,
            ],
            [
                'name' => 'Minyak Goreng Sawit 2L',
                'description' => 'Minyak goreng kelapa sawit jernih kemasan pouch 2 liter.',
                'price' => 36000,
                'stock' => 60,
            ],
            [
                'name' => 'Gula Pasir Kristal Putih 1kg',
                'description' => 'Gula pasir murni dari tebu pilihan kemasan 1 kilogram.',
                'price' => 17500,
                'stock' => 80,
            ],
            [
                'name' => 'Mie Instan Goreng (1 Dus / 40 Pcs)',
                'description' => 'Paket karton mie instan rasa goreng isi 40 bungkus untuk stok grosir.',
                'price' => 118000,
                'stock' => 25,
            ],
            [
                'name' => 'Kopi Bubuk Instan Sachet (1 Renceng)',
                'description' => 'Kopi hitam bubuk instan kemasan renceng isi 10 sachet.',
                'price' => 14500,
                'stock' => 100,
            ],
            [
                'name' => 'Tepung Terigu Serbaguna 1kg',
                'description' => 'Tepung terigu protein sedang untuk aneka olahan makanan dan kue.',
                'price' => 13000,
                'stock' => 35,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                [
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                ]
            );
        }
    }
}

