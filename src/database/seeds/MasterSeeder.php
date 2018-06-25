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
        $node_staff = \Solunes\Master\App\Node::create(['name'=>'staff', 'location'=>'staff', 'folder'=>'parameters']);
        $node_staff_wage = \Solunes\Master\App\Node::create(['name'=>'staff-wage', 'location'=>'staff', 'type'=>'child', 'parent_id'=>$node_staff->id]);
        $node_staff_payment = \Solunes\Master\App\Node::create(['name'=>'staff-payment', 'location'=>'staff', 'type'=>'child', 'parent_id'=>$node_staff->id]);

        /*$admin = \Solunes\Master\App\Role::where('name', 'admin')->first();
        $member = \Solunes\Master\App\Role::where('name', 'member')->first();
        $staff_perm = \Solunes\Master\App\Permission::create(['name'=>'staff', 'display_name'=>'Negocio']);
        $admin->permission_role()->attach([$staff_perm->id]);*/

    }
}