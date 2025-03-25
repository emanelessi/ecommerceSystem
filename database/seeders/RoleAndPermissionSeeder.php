<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage products', 'create products', 'edit products', 'delete products',
            'view products', 'manage product categories',
            'view orders', 'update order status', 'manage shipping', 'process refunds',
            'manage customers', 'view customer details',
            'manage content', 'edit pages', 'delete pages', 'publish pages',
            'view reports', 'view sales reports', 'view customer insights',
            'manage store settings', 'manage payment methods', 'manage discount codes',
            'manage users', 'assign roles', 'edit users', 'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        Role::firstOrCreate(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::firstOrCreate(['name' => 'content manager'])->givePermissionTo([
            'manage content', 'edit pages', 'delete pages', 'publish pages'
        ]);
        Role::firstOrCreate(['name' => 'order manager'])->givePermissionTo([
            'view orders', 'update order status', 'manage shipping', 'process refunds'
        ]);
        Role::firstOrCreate(['name' => 'customer'])->givePermissionTo([
            'view products', 'view orders'
        ]);
        Role::firstOrCreate(['name' => 'user'])->givePermissionTo([
            'view products'
        ]);
    }
}
