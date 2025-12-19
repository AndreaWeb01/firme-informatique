<?php

namespace Database\Factories;

use App\Models\Conseils;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conseils>
 */
class ConseilsFactory extends Factory
{
    protected $model = Conseils::class;

    public function definition(): array
    {
        $titre = $this->faker->sentence();

        return [
            'titre'       => $titre,
            'slug'        => Str::slug($titre),
            'description' => $this->faker->paragraph(5),
            'image'       => $this->faker->imageUrl(640, 480),
        ];
    }
}
