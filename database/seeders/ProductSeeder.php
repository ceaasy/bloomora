<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Buket Mawar Merah',
                'category' => 'Buket',
                'description' => 'Buket mawar merah segar, cocok untuk momen romantis atau ucapan spesial.',
                'photo' => 'products/buket-mawar-merah.jpeg',
                'stock' => 25,
                'price_small' => 60000,
                'price_medium' => 95000,
                'price_large' => 150000,
                'customization_options' => [
                    ['name' => 'Tambah Pita 1', 'price' => 5000],
                    ['name' => 'Tambah Kertas Wrapping', 'price' => 10000],
                    ['name' => 'Tambah Boneka Mini', 'price' => 25000],
                ],
            ],
            [
                'name' => 'Hampers Snack Lebaran',
                'category' => 'Hampers',
                'description' => 'Paket hampers berisi aneka snack kekinian, cocok untuk hantaran lebaran.',
                'photo' => 'products/hampers_lebaran.jpeg',
                'stock' => 15,
                'price_small' => 100000,
                'price_medium' => 175000,
                'price_large' => 250000,
                'customization_options' => [
                    ['name' => 'Tambah Boneka Mini', 'price' => 25000],
                    ['name' => 'Tambah Bunga Mini', 'price' => 30000],
                ],
            ],
        ];
 
        foreach ($products as $product) {
            Product::create($product);
        }
    
    }
}
