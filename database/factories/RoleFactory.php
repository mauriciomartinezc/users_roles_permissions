<?php

namespace Database\Factories;

use App\Models\Permission;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->colorName,
        ];
    }
}
