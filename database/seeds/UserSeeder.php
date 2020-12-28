<?php

use App\Category;
use App\Post;
use App\Profile;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user =User::create([
            'name'=>'mostafa',
            'email'=>'magdymostafa726@gmail.com',
            'password'=>Hash::make('12345678'),
            'admin'=>1,
        ]);

        $category=Category::create(['name'=>'first']);

        Profile::create([
            'user_id' => $user->id,
            'avatar' => '1.png',
            'about' => 'this my Blog website i hape that this website be good and useful  ',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);


        Post::create([
            'title'=>'first post',
            'slug'=>strtolower(str_replace(' ','-','first post')),
            'content'=>'this is my first post in this amazing blog ',
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'featured'=>'1.png',
        ]);

    }
}

