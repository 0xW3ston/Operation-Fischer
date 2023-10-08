<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $iterations = (int) 2000000 / 200000;

        // for($i = 0;$i < $iterations;$i++){
        //     $articles = Article::factory(200000)->make();

        //     $article_chunks = $articles->chunk(15000);
    
        //     $article_chunks->each(function ($chunk) {
        //         Article::insert($chunk->toArray());
        //     });

        //     unset($article_chunks, $articles, $chunk);
        // }

        Article::factory(10)
        ->create();
    }
}
