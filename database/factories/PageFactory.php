<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\Notebook;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition()
    {
        $notebook = Notebook::all()->random();

        return [
            'notebook_id' => $notebook->id,
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->paragraphs(3, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

