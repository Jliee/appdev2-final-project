<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // TruncateTablesSeeder::class,
            // UserSeeder::class,
            NotebookSeeder::class,
            PageSeeder::class
        ]);
    }
}
