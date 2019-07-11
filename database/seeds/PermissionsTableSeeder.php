<?php

use Illuminate\Database\Seeder;
use App\Permission;
use Illuminate\Support\Facades\DB;
use App\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        //Crud Posts
        $crudPost = new Permission();
        $crudPost->name = 'crud-post';
        $crudPost->display_name = 'Crud Posts'; // optional
        $crudPost->save();
        //update others posts
        $updateOtherPost = new Permission();
        $updateOtherPost->name = 'update-other-post';
        $updateOtherPost->display_name = 'Update Other Posts'; // optional
        $updateOtherPost->save();
        //delete others posts
        $deleteOtherPost = new Permission();
        $deleteOtherPost->name = 'delete-other-post';
        $deleteOtherPost->display_name = 'Delete Other Posts'; // optional
        $deleteOtherPost->save();
        //Crud Category
        $crudCategory = new Permission();
        $crudCategory->name = 'crud-category';
        $crudCategory->display_name = 'Crud Category'; // optional
        $crudCategory->save();
        //Crud User
        $crudUser = new Permission();
        $crudUser->name = 'crud-user';
        $crudUser->display_name = 'Crud User'; // optional
        $crudUser->save();

        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();

        $admin->detachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory,$crudUser]);
        $admin->attachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory,$crudUser]);

        $editor->detachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory]);
        $editor->attachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory]);

        $author->detachPermissions([$crudPost]);
        $author->attachPermissions([$crudPost]);

    }
}
