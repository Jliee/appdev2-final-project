<?php

namespace Database\Factories;

use App\Models\Notebook;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotebookFactory extends Factory
{
    protected $model = Notebook::class;

    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,  // Using existing users
            'title' => $this->faker->sentence(3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

