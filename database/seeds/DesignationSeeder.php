<?php

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Designation::updateOrCreate(['id'=>1],['name'=>'user']);
          \App\Designation::updateOrCreate(['id'=>2],['name'=>'admin']);
            \App\Designation::updateOrCreate(['id'=>3],['name'=>'teacher']);
    }
}
