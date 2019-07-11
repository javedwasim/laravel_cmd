<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        //Create Admin Role
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Project Owner'; // optional
        $admin->description  = 'User is the owner of a given project'; // optional
        $admin->save();
        //Create Editor Role
        $editor = new Role();
        $editor->name         = 'editor';
        $editor->display_name = 'Project editor'; // optional
        $editor->description  = 'User is the editor of a given project'; // optional
        $editor->save();
        //Create Author Role
        $author = new Role();
        $author->name         = 'author';
        $author->display_name = 'Project author'; // optional
        $author->description  = 'User is the author of a given project'; // optional
        $author->save();

        //Admin user
        $user1 = \App\User::find(1);
        $user1->detachROle($admin);
        $user1->attachROle($admin);
        //Editor user
        $user2 = \App\User::find(2);
        $user2->detachROle($editor);
        $user2->attachROle($editor);
        //Editor user
        $user3 = \App\User::find(3);
        $user3->detachROle($author);
        $user3->attachROle($author);

    }
}
