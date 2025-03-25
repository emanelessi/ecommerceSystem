<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@admin.com', 'role' => 'admin'],
            ['name' => 'Content Manager', 'email' => 'content@store.com', 'role' => 'content manager'],
            ['name' => 'Order Manager', 'email' => 'orders@store.com', 'role' => 'order manager'],
            ['name' => 'Customer 1', 'email' => 'customer1@store.com', 'role' => 'customer'],
            ['name' => 'Customer 2', 'email' => 'customer2@store.com', 'role' => 'customer'],
            ['name' => 'Customer 3', 'email' => 'customer3@store.com', 'role' => 'customer'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('123456'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );

            $user->assignRole($userData['role']);
        }
    }
}
