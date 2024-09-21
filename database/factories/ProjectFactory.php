<?php

namespace Database\Factories;

use App\Models\Organizer;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        Tag::create(['name'=>'Building']);
        Organizer::factory()->create();

        return [
            'tag_id' => Tag::inRandomOrder()->first()->id,
            'organizer_id' => Organizer::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'description' => fake()->text(),
            'amount' => fake()->randomFloat(2, 1, 10000),
            'collected_fund' => fake()->randomFloat(2, 1, 10000),
        ];
    }
}
