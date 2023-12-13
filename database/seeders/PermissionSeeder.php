<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'payment-history_list',
            'slider-list',
            'banner-list',
            'web_setup',
            'staff-list',
            'staff-create',
            'staff-edit',
            'staff-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        foreach ($permissions as $permission) {
            $data=explode('-',$permission);

            $permission_data = Permission::where('name', $permission)->first();
            if(!$permission_data){
                $permission_data = new Permission;
            }
            $permission_data->name=$permission;
            $permission_data->parent_name=$data[0];
            $permission_data->guard_name = 'admin';
            $permission_data->save();
        }
    }
}
