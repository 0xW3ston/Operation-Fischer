<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePaths = Storage::disk('local')->files('public/product');
        // $catId = Categorie::factory()->create()->id;
        return [
            "categorie_id" => 4,
            "name" => fake()->name(),
            "description" => fake()->sentence(4),
            "price" => fake()->randomFloat(4,0,99.99),
            "img_path" => substr($imagePaths[array_rand($imagePaths)],7)
        ];
    }
}
