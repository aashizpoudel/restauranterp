<?php

use Illuminate\Database\Seeder;

class AddonassignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Addons_Food::class, 15)->create();
    }
}
