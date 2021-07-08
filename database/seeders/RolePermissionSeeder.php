<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
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
            //stock
            [
                'group_name' => 'stock',
                'perm_name' => [
                    'stock.add',
                    'stock.view',
                    // 'stock.edit',
                    // 'stock.delete',
                ]
            ],
            //sell
            [
                'group_name' => 'sell',
                'perm_name' => [
                    'sell.view',
                    'sell.create',
                    'sell.edit',
                    'sell.delete',
                ]
            ],
            //expense-type
            [
                'group_name' => 'expense-type',
                'perm_name' => [
                    'expense-type.view',
                    'expense-type.create',
                    'expense-type.edit',
                    'expense-type.delete',
                ]
            ],
            //expense
            [
                'group_name' => 'expense',
                'perm_name' => [
                    'expense.view',
                    'expense.create',
                    'expense.edit',
                    'expense.delete',
                    'expense.statement',
                ]
            ],
            //bank-account
            [
                'group_name' => 'bank-account',
                'perm_name' => [
                    'bank-account.view',
                    'bank-account.create',
                    'bank-account.edit',
                    'bank-account.delete',
                ]
            ],
            //bank-transaction
            [
                'group_name' => 'bank-transaction',
                'perm_name' => [
                    'bank-transaction.view',
                    'bank-transaction.create',
                    'bank-transaction.edit',
                    'bank-transaction.delete',
                    'bank-transaction.ledger',
                ]
            ],
            //business-setting
            [
                'group_name' => 'business-setting',
                'perm_name' => [
                    'business-setting.view',
                    'business-setting.create',
                    // 'business-setting.edit'
                ]
            ],
            //payment-type
            [
                'group_name' => 'payment-type',
                'perm_name' => [
                    'payment-type.view',
                    'payment-type.create',
                    'payment-type.edit',
                    'payment-type.delete',
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

        $user = User::where('id','1')->first();
        $user->syncRoles($super_admin);
    }
}
