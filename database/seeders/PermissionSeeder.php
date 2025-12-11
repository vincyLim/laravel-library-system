<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the permissions
        $permissions = [
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
        ];

        // Loop through each permission and create it in the database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
