<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Role; // Import the Role model

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Corrected method name to firstOrCreate
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $librarian = Role::firstOrCreate(['name' => 'Librarian']);
        $user = Role::firstOrCreate(['name' => 'User']);

        $admin->permissions()->attach(Permission::whereIn('name', [
            'viewAny-user',
            'view-user',
            'create-user',
            'update-user',
            'delete-user',
            'create-book',
            'viewAny-book',
            'update-book',
            'delete-book',
            'view-book',
            'viewAny-borrow-record',
            'view-borrow-record',
            'approve-borrow-and-return-book',
            'viewAny-penalty',
            'pay-penalty',
            'viewAny-author',
            'view-author',
            'create-author',
            'update-author',
            'delete-author',
            'viewAny-category',
            'view-category',
            'create-category',
            'update-category',
            'delete-category',
            'viewAny-permission',
        ])->pluck('id')->toArray()); // Attach multiple permissions to the admin role

        $librarian->permissions()->attach(Permission::whereIn('name', [
            'viewAny-book',
            'create-book',
            'update-book',
            'delete-book',
            'view-book',
            'viewAny-borrow-record',
            'approve-borrow-and-return-book',
            'viewAny-penalty',
            'pay-penalty',
            'viewAny-author',
            'view-author',
            'create-author',
            'update-author',
            'delete-author',
            'viewAny-category',
            'view-category',
            'create-category',
            'update-category',
            'delete-category'
        ])->pluck('id')->toArray()); // Attach multiple permissions to the librarian role
    }
}