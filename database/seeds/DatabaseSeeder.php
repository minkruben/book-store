<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 50)->create();

        factory('App\Category', 50)->create()->each(function($category) {
            $books = $category->books()->saveMany(factory('App\Book', 5)->make()->all());
            $authors = $books[0]->authors()->saveMany(factory('App\Author', 2)->make()->all());
            $authors[0]->books()->save($books[4]);
            $authors[1]->books()->saveMany([$books[1], $books[3]]);
            $books[1]->authors()->saveMany(factory('App\Author', 2)->make()->all());
            $books[2]->authors()->saveMany(factory('App\Author', 4)->make()->all());
            $books[3]->authors()->attach(factory('App\Author')->make());
        });
    }
}
