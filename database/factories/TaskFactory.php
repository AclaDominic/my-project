<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => Str::random(10), // Generates a random 10-character string
            'description' => Str::random(20), // Generates a random 50-character string
        ];
    }
}
