<?php

namespace Database\Seeders;

use App\Models\Post\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        // Posts without a link to a category
        Post::factory(10)->unpublished()->create();
        Post::factory(25)->published()->create();
        Post::factory(10)->planned()->create();
    }
}
