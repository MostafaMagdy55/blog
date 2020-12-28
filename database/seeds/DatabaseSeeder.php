<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(SettingsTableSeeder::class);

         factory('App\Tag',10)->create();
         factory('App\Category',10)->create();
        $users= factory('App\Post',50)->create();
        $tag_id=[];
        $tag_id[]=Tag::all()->random()->id;
        foreach ($users as $user) {
          $user->tags()->sync($tag_id);
        }
         factory('App\Profile',10)->create();

    }
}
