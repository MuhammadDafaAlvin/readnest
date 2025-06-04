<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $writerRole = Role::where('name', 'writer')->first()->id;
        $writers = User::where('role_id', $writerRole)->get();

        foreach ($writers as $writer) {
            Author::create([
                'user_id' => $writer->id,
                'bio' => 'Biografi penulis ' . $writer->name,
            ]);
        }
    }
}
