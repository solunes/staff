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
        \Solunes\Staff\App\Staff::truncate();
        \Solunes\Staff\App\StaffCategory::truncate();
    }
}