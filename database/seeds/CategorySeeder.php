<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Attico',
            'Loft',
            'Villa',
            'Casa Vacanze',
            'B&B',
            'Hotel'
        ];

         foreach ($categories as $nome) {
            Category::firstOrCreate(['nome' => $nome]);
        }
    }
}
