<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 2; $i++) {
                $title = $faker->sentence(6);
                $content = $faker->paragraphs(3, true);
                $startDate = $faker->dateTimeThisMonth;
                $endDate = $faker->dateTimeBetween($startDate, '+1 week');

                $news = new News([
                    'title' => $title,
                    'content' => $content,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'category_id' => $category->id,
                ]);

                $news->save();
            }
        }
    }
}
