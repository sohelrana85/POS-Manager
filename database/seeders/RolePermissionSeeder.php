<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::create(['name' => 'Super Admin']);

        $permissions = [
            //Dashboard
            [
                'group_name' => 'dashboard',
                'perm_name' => [
                    'dashboard.view'
                ]
            ],
            //Role
            [
                'group_name' => 'role',
                'perm_name' => [
                    'role.view',
                    'role.create',
                    'role.edit',
                    'role.delete'
                ]
            ],
            //user
            [
                'group_name' => 'user',
                'perm_name' => [
                    'user.view',
                    'user.create',
                    'user.edit',
                    'user.delete'
                ]
            ],
            //customer
            [
                'group_name' => 'customer',
                'perm_name' => [
                    'customer.view',
                    'customer.create',
                    'customer.edit',
                    'customer.delete'
                ]
            ],
            //supplier
            [
                'group_name' => 'supplier',
                'perm_name' => [
                    'supplier.view',
                    'supplier.create',
                    'supplier.edit',
                    'supplier.delete',
                    'supplier.return',
                    'supplier.due-payment',
                ]
            ],
            //product
            [
                'group_name' => 'product',
                'perm_name' => [
                    'product.view',
                    'product.create',
                    'product.edit',
                    'product.delete',
                    'print-barcode'
                ]
            ],
            //unit
            [
                'group_name' => 'unit',
                'perm_name' => [
                    'unit.view',
                    'unit.create',
                    'unit.edit',
                    'unit.delete',
                ]
            ],
            //package size
            [
                'group_name' => 'package-size',
                'perm_name' => [
                    'package-size.view',
                    'package-size.create',
                    'package-size.edit',
                    'package-size.delete',
                ]
            ],
            //category
            [
                'group_name' => 'category',
                'perm_name' => [
                    'category.view',
                    'category.create',
                    'category.edit',
                    'category.delete',
                ]
            ],
            //brand
            [
                'group_name' => 'brand',
                'perm_name' => [
                    'brand.view',
                    'brand.create',
                    'brand.edit',
                    'brand.delete',
                ]
            ],
            //purchase
            [
                'group_name' => 'purchase',
                'perm_name' => [
                    'purchase.view',
                    'purchase.create',
                    'purchase.edit',
                    'purchase.delete',
                ]
            ],
        ];

        foreach ($permissions as $data) {
            for ($i=0; $i < count($data['perm_name']) ; $i++) {
                $permission = Permission::create([
                    'group_name' => $data['group_name'],
                    'name' => $data['perm_name'][$i],
                ]);

                $super_admin->givePermissionTo($permission);
                $permission->assignRole($super_admin);
            }

        }
    }
}
