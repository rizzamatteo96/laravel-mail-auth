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
        // creo un array di dati
        $categories = ['Html', 'CSS', 'JS', 'Python'];

        foreach($categories as $category){
            // creo istanza
            $newCategories = new Category();

            // assegno valore a 'name' istanza
            $newCategories->name = $category;

            // creo uno slug
            $slug = Str::slug($category, '-');
            $newCategories->slug = $slug;

            // salvo i dati nella tabella di destinazione
            $newCategories->save();
        }
    }
}