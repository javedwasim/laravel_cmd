<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        $faker = Factory::create();

        DB::table('users')->insert([
            [
                'name'=>'John Doe',
                'slug'=>'john-doe',
                'email'=>'john@doe.com',
                'password'=>bcrypt('secret'),
                'bio'=>$faker->text(rand(250,300)),
            ],
            [
                'name'=>'Jane Doe',
                'slug'=>'jane-doe',
                'email'=>'jane@doe.com',
                'password'=>bcrypt('secret'),
                'bio'=>$faker->text(rand(250,300)),
            ],
            [
                'name'=>'Edo Doe',
                'slug'=>'edo-doe',
                'email'=>'edo@doe.com',
                'password'=>bcrypt('secret'),
                'bio'=>$faker->text(rand(250,300)),
            ]

        ]);
    }
}
