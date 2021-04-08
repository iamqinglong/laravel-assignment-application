<?php

namespace Database\Seeders;

use App\Models\Post\Post;
use Illuminate\Database\Seeder;
use App\Models\Category\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categories linked to 5 posts
        Category::factory(5)->has(Post::factory()->count(5))->create();

        // Categories without a link
        Category::factory(5)->create();
    }
}
