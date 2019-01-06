<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'table_management_access',],
            ['id' => 18, 'title' => 'option_access',],
            ['id' => 19, 'title' => 'option_create',],
            ['id' => 20, 'title' => 'option_edit',],
            ['id' => 21, 'title' => 'option_view',],
            ['id' => 22, 'title' => 'option_delete',],
            ['id' => 23, 'title' => 'questiontype_access',],
            ['id' => 24, 'title' => 'questiontype_create',],
            ['id' => 25, 'title' => 'questiontype_edit',],
            ['id' => 26, 'title' => 'questiontype_view',],
            ['id' => 27, 'title' => 'questiontype_delete',],
            ['id' => 28, 'title' => 'question_access',],
            ['id' => 29, 'title' => 'question_create',],
            ['id' => 30, 'title' => 'question_edit',],
            ['id' => 31, 'title' => 'question_view',],
            ['id' => 32, 'title' => 'question_delete',],
            ['id' => 33, 'title' => 'poll_access',],
            ['id' => 34, 'title' => 'poll_create',],
            ['id' => 35, 'title' => 'poll_edit',],
            ['id' => 36, 'title' => 'poll_view',],
            ['id' => 37, 'title' => 'poll_delete',],
            ['id' => 38, 'title' => 'response_access',],
            ['id' => 39, 'title' => 'response_create',],
            ['id' => 40, 'title' => 'response_edit',],
            ['id' => 41, 'title' => 'response_view',],
            ['id' => 42, 'title' => 'response_delete',],
            ['id' => 43, 'title' => 'vote_access',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
