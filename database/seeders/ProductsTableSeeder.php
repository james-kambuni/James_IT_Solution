<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Norton Internet Security',
            'description' => 'Comprehensive antivirus protection',
            'price' => 25.00,
            'image' => 'images/it_service/1.jpg'
        ]);
    
        \App\Models\Product::create([
            'name' => 'Norton Internet Security',
            'description' => 'Comprehensive antivirus protection',
            'price' => 25.00,
            'image' => 'images/it_service/4.jpg'
        ]);

        \App\Models\Product::create([
            'name' => 'Mcafee Livesafe Antivirus',
            'description' => 'Comprehensive antivirus protection',
            'price' => 25.00,
            'image' => 'images/it_service/3.jpg'
        ]);

        \App\Models\Product::create([
            'name' => 'Kaspersky Internet Security',
            'description' => 'Comprehensive antivirus protection',
            'price' => 400.00,
            'image' => 'images/it_service/2.jpg'
        ]);
    }
}
