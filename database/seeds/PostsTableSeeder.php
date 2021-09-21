<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            $newPost = new Post();

            $newPost->title = 'Articolo numero ' . ($i + 1);
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->description = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, error corrupti. Incidunt repellat maxime illum placeat numquam neque dignissimos porro qui voluptate, cum sapiente delectus alias quis, dolores ipsam iste.';

            $newPost->save();
        }
    }
}
