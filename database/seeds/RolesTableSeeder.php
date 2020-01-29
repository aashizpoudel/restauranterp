<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            ['name' => 'Admin','slug'=>'admin'],
            ['name' => 'Manager','slug'=>'manager'],
            ['name' => 'Worker','slug'=>'worker'],
            ['name' => 'Customer','slug'=>'customer']
           ]);
    }
}
