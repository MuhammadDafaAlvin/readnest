<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            AuthorSeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
