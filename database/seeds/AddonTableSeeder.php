<?php

use Illuminate\Database\Seeder;

class AddonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Add_on::class, 15)->create();
    }
}
