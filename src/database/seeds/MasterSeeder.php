<?php

namespace Solunes\Staff\Database\Seeds;

use Illuminate\Database\Seeder;
use DB;

class MasterSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $node_product_stock = \Solunes\Master\App\Node::create(['name'=>'product-stock', 'type'=>'child', 'location'=>'staff', 'parent_id'=>$node_product->id]);
        $node_purchase = \Solunes\Master\App\Node::create(['name'=>'purchase', 'location'=>'staff', 'folder'=>'products']);
        $node_purchase_product = \Solunes\Master\App\Node::create(['name'=>'purchase-product', 'type'=>'child', 'location'=>'staff', 'parent_id'=>$node_purchase->id]);
        $node_staff_movement = \Solunes\Master\App\Node::create(['name'=>'staff-movement', 'location'=>'staff', 'folder'=>'products']);
        // Usuarios
        $admin = \Solunes\Master\App\Role::where('name', 'admin')->first();
        $member = \Solunes\Master\App\Role::where('name', 'member')->first();
        $staff_perm = \Solunes\Master\App\Permission::create(['name'=>'staff', 'display_name'=>'Negocio']);
        $admin->permission_role()->attach([$staff_perm->id]);

    }
}