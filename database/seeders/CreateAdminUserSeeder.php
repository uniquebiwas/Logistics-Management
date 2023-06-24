<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' =>  [
                'np' => 'Biwas',
                'en' => 'Biwas'
            ],
            'email' => 'biwas@gmail.com',
            'password' => Hash::make('admin123'),
            'accountNumber' => '12345',
        ]);

        UserType::create([
            'userId' => $user->id,
            'typeId' => 1,
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $role_admin = Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Staff']);

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
