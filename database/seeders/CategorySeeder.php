<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Teknologi'],
            ['name' => 'Gaya Hidup'],
            ['name' => 'Pendidikan'],
            ['name' => 'Kesehatan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
