<?php

namespace Solunes\Staff\Database\Seeds;

use Illuminate\Database\Seeder;
use DB;

class TruncateSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Solunes\Staff\App\StaffMovement::truncate();
        \Solunes\Staff\App\PurchaseProduct::truncate();
        \Solunes\Staff\App\Purchase::truncate();
        \Solunes\Staff\App\ProductStock::truncate();
    }
}