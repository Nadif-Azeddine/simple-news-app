<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Actualités',
                'parent_id' => null,
            ],
            [
                'name' => 'Politique',
                'parent_id' => 1,
            ],
            [
                'name' => 'Économie',
                'parent_id' => 1,
            ],
            [
                'name' => 'Sport',
                'parent_id' => 1,
            ],
            [
                'name' => 'Divertissement',
                'parent_id' => null,
            ],
            [
                'name' => 'Cinéma',
                'parent_id' => 5,
            ],
            [
                'name' => 'Musique',
                'parent_id' => 5,
            ],
            [
                'name' => 'Sorties',
                'parent_id' => 5,
            ],
            [
                'name' => 'Technologie',
                'parent_id' => null,
            ],
            [
                'name' => 'Informatique',
                'parent_id' => 9,
            ],
            [
                'name' => 'Santé',
                'parent_id' => null,
            ],
            [
                'name' => 'Médecine',
                'parent_id' => 11,
            ],
            [
                'name' => 'Bien-être',
                'parent_id' => 11,
            ],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }

    }
}
