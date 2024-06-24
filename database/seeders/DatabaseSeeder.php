<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'admin' => true,
            'email' => 'admin@example.com',
            'password' => 'admin'
        ]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'teste123'
        ]);

        $user2 = User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => 'teste123'
        ]);

        Post::factory()->create([
            'title' => 'Lorem Ipsum',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'published' => false,
            // 'published' => 'F',
            'author_id' => $user->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Post::factory()->create([
            'title' => 'Lorem Ipsum First',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'published' => true,
            // 'published' => 'F',
            'author_id' => $user->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $post = Post::factory()->create([
            'title' => 'Lorem Ipsum Second',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'published' => true,
            // 'published' => 'F',
            'author_id' => $user2->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        PostComment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content'  => 'Comentário do usuário 1 no post do usuário 2.'
        ]);
    }
}
