<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $articles = Article::all()->pluck('id')->toArray();
        $users = User::all()->pluck('id')->toArray();

        $comments = [
            [
                'content' => 'Artikel yang sangat informatif!',
                'article_id' => $articles[array_rand($articles)],
                'user_id' => $users[array_rand($users)],
            ],
            [
                'content' => 'Terima kasih atas tipsnya!',
                'article_id' => $articles[array_rand($articles)],
                'user_id' => $users[array_rand($users)],
            ],
            [
                'content' => 'Bisa tambah contoh kode lagi?',
                'article_id' => $articles[array_rand($articles)],
                'user_id' => $users[array_rand($users)],
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
