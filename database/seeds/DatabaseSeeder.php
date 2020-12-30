<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(user::class);
         $this->call(project::class);
         $this->call(neighborhood::class);
         $this->call(roles::class);
//         $this->call('volunteer_factory');
    }
}
