<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notebook;

class NotebookSeeder extends Seeder
{
    public function run()
    {
        Notebook::factory()->count(30)->create();
    }
}

