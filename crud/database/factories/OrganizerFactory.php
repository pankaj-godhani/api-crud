<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'profile_url' => 'https://dummyimage.com/400x300/00ff00/000',
            'position' => fake()->jobTitle(),
        ];
    }
}
