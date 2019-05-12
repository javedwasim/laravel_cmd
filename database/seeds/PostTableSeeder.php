<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

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
        $date = Carbon::create(2019,5,07,9);
        for($j=0;$j<10;$j++){

            $image = "Post_Image".rand(1,5).".jpg";
            //$date = date("Y-m-d H:i:s", strtotime("2019-04-25 08:00:00 +{$j} days"));
            $date->addDays(1);
            $publishedDate = clone($date);

            $posts[] = [
                'author_id' => rand(1,3),
                'title' => $faker->sentence(rand(8,12)),
                'excerpt' => $faker->text(rand(250,300)),
                'body' => $faker->paragraph(rand(10,15),true),
                'slug' => $faker->slug(),
                'image' => rand(0,1)==1?$image:NULL,
                'created_at' => clone($date),
                'updated_at' => clone($date),
                'published_at' => $j<5? $publishedDate:(rand(1,0)==0?NULL:$publishedDate->addDays(4) ),
                'view_count' => rand(1,10)*10,
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
