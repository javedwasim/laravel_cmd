<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('users')->insert([
            [
                'name'=>'John Doe',
                'email'=>'john@doe.com',
                'password'=>bcrypt('secret'),
            ],
            [
                'name'=>'Jane Doe',
                'email'=>'jane@doe.com',
                'password'=>bcrypt('secret'),
            ],
            [
                'name'=>'Edo Doe',
                'email'=>'edo@doe.com',
                'password'=>bcrypt('secret'),
            ]

        ]);
    }
}
