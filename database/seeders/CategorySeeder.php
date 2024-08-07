<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'geral']);
        Category::create(['name' => 'comida']);
        Category::create(['name' => 'bebida']);
        Category::create(['name' => 'congelados']);
        Category::create(['name' => 'higiene']);
        Category::create(['name' => 'limpeza']);
    }
}
