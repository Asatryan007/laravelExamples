<?php

namespace Database\Factories;

use App\Models\Task;
//use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    public function definition(): array
    {
        return [

            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'startedAt' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'completedAt' => $this->faker->dateTimeBetween('now', '+1 month'),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(Task::statusOption()),

        ];
    }
}
