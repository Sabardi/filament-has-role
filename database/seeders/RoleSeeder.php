<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Buat user admin
        $adminUser = User::create([
           'name' => 'admin',
           'email' => 'admin@admin.com', 
           'password' => bcrypt('admin@admin.com'),
        ]);

        $adminUser->assignRole($adminRole);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com', 
            'password' => bcrypt('user@user.com'),
         ]);

         $user->assignRole($userRole);
    }
}
