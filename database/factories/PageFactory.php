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
        return [
            'notebook_id' => Notebook::all()->random()->id, //belong to a random notebook
            'notebook_title' => Notebook::all()->random()->title,
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->paragraphs(3, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

