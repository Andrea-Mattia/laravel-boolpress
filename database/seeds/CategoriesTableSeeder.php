<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['HTML', 'CSS', 'JavaScript', 'PHP'];

        foreach ($categories as $category) {
            // 1 new instance
            $new_category = new Category();
            // 2 population
            $new_category->name = $category;
            $new_category->slug = Str::slug($category, '-');
            // 3 save to db
            $new_category->save();
        }
    }
}
