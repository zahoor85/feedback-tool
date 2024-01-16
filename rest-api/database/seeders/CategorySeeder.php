<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert 'Bug Report'
        Category::create(['name' => 'Bug Report']);

        // Insert 'Feature Request'
        Category::create(['name' => 'Feature Request']);

        // Insert 'Improvement'
        Category::create(['name' => 'Improvement']);

        Category::factory()
            ->create();
    }
}
