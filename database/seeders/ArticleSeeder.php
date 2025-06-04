<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all()->pluck('id')->toArray();
        $authors = Author::all()->pluck('id')->toArray();

        $articles = [
            [
                'title' => 'Pengenalan ke AI',
                'content' => 'Artikel tentang kecerdasan buatan dan aplikasinya.',
                'category_id' => $categories[array_rand($categories)],
                'author_id' => $authors[array_rand($authors)],
                'image' => 'https://picsum.photos/640/480?random=' . rand(1, 1000),
            ],
            [
                'title' => 'Tips Hidup Sehat',
                'content' => 'Cara menjaga kesehatan dengan pola makan dan olahraga.',
                'category_id' => $categories[array_rand($categories)],
                'author_id' => $authors[array_rand($authors)],
                'image' => 'https://picsum.photos/640/480?random=' . rand(1, 1000),
            ],
            [
                'title' => 'Belajar Laravel 12',
                'content' => 'Panduan untuk memulai dengan Laravel 12.',
                'category_id' => $categories[array_rand($categories)],
                'author_id' => $authors[array_rand($authors)],
                'image' => 'https://picsum.photos/640/480?random=' . rand(1, 1000),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
