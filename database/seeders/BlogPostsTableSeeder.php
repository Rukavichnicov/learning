<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 999; ++$i) {
            $title = fake()->sentence(rand(3, 8));
            $txt = fake()->realText(rand(1000, 4000));
            $isPublished = rand(1, 5) > 1;
            $createdAd = fake()->dateTimeBetween('-3 months', '-2 months');

            DB::table('blog_posts')->insert([
                'category_id' => rand(1, 10),
                'user_id' => (rand(1, 5) === 5) ? 1 : 2,
                'slug' => Str::slug($title),
                'title' => $title,
                'excerpt' => fake()->text(rand(40, 100)),
                'content_raw' => $txt,
                'content_html' => $txt,
                'is_published' => $isPublished,
                'published_at' => $isPublished ? fake()->dateTimeBetween('-2 months', '-1 days') : null,
                'created_at' => $createdAd,
                'updated_at' => $createdAd,
            ]);
        }
    }
}
