<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Pria',
            'description' => 'Products for men',
        ]);

        Category::create([
            'name' => 'Wanita',
            'description' => 'Products for women',
        ]);

        Category::create([
            'name' => 'Anak Pria',
            'description' => 'Products for boys',
        ]);

        Category::create([
            'name' => 'Anak Wanita',
            'description' => 'Products for girls',
        ]);

        Category::create([
            'name' => 'Parfum',
            'description' => 'Perfume and fragrance products',
        ]);
    }
}
