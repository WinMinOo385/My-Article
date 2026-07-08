<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->createMany([
            [
                'name' => 'WMO',
                'email' => 'wmo@dev.com',
                'password' => 'P@ssw0rd',
            ],
            [
                'name' => 'developer',
                'email' => 'dev@dev.com',
                'password' => 'P@ssw0rd',
            ],
        ]);

        Categories::factory(6)->create();

        Article::factory(10)->create();

        Comment::factory(30)->create();
    }
}
