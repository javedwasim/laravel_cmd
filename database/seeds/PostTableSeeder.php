<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        $posts = [];
        $faker = Factory::create();

        for($j=0;$j<10;$j++){

            $image = "Post_Image".rand(1,5).".jpg";
            $date = date("Y-m-d H:i:s", strtotime("2019-04-25 08:00:00 +{$j} days"));

            $posts[] = [
                'author_id' => rand(1,3),
                'title' => $faker->sentence(rand(8,12)),
                'excerpt' => $faker->text(rand(250,300)),
                'body' => $faker->paragraph(rand(10,15),true),
                'slug' => $faker->slug(),
                'image' => rand(0,1)==1?$image:NULL,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
