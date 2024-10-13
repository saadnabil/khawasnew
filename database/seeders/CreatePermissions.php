<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreatePermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard',

            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'admin-export',

            'item-list',
            'item-create',
            'item-edit',
            'item-delete',
            'item-export',

            'order-list',
            'order-show',
            'order-track',
            'order-print-invoice',
            'order-send-invoice',
            'order-edit-status',
            'order-export',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-export',


            'item-type-list',
            'item-type-create',
            'item-type-edit',
            'item-type-delete',
            'item-type-export',


            'item-tax-list',
            'item-tax-create',
            'item-tax-edit',
            'item-tax-delete',
            'item-tax-export',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-export',

            'coupon-list',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',
            'coupon-export',

            'ticket-list',
            'ticket-edit',
            'ticket-close',
            'ticket-my',
            'ticket-chat-replay',
            'settings',
            'admin-titl',
            'chatting',
            'can-edit-order',
            'can-delete-order',
            'edit-lic',
            'delete-lic'

          
           

           

        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'name' => $permission,
                    'guard_name' => 'admin',
                ],
            );
        }
    }
}
