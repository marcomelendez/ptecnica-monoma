<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = \App\Models\User::inRandomOrder()->first();

        return [
            'name'=>fake()->name(),
            'source'=>Str::random(10),
            'owner'=>$user->id,
            'created_by'=>1
        ];
    }
}
