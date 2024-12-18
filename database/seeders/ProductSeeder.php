<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->truncate();
        Product::insert([
            [
                'name' => 'Laptop',
                'price' => 1200,
                'quantity' => 10,
                'category_id'=>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartphone',
                'price' => 700,
                'quantity' => 25,
                'category_id'=>2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tablet',
                'price' => 350,
                'quantity' => 15,
                'category_id'=>3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iPad',
                'price' => 2500,
                'quantity' => 5,
                'category_id'=>4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PC',
                'price' => 3500,
                'quantity' => 35,
                'category_id'=>5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
