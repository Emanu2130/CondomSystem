<?php

use Illuminate\Database\Seeder;
session_start();
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\tbl_inmueble', 20)->create();
    }
}
