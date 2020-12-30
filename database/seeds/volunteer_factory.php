<?php

use Illuminate\Database\Seeder;

class volunteer_factory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory( 'App\volunteerProject', 25 )->create();
    }
}
