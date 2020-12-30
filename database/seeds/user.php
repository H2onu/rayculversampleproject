<?php

	use Illuminate\Database\Seeder;
	use Carbon\Carbon;


	class user extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {


			DB::table( 'users' )->insert( [
				'name'     => 'Ray',
				'email'    => '@.com',
				'password' => bcrypt( '' ),

			] );

			DB::table( 'users' )->insert( [
				'name'     => 'Block Captain',
				'email'    => 'block@test.com',
				'password' => bcrypt( '' ),
			] );

			DB::table( 'users' )->insert( [
				'name'     => 'City Admin',
				'email'    => 'city@test.com',
				'password' => bcrypt( '' ),
			] );

			DB::table( 'users' )->insert( [
				'name'     => 'Volunteer',
				'email'    => 'volunteer@test.com',
				'password' => bcrypt( '' ),
			] );


		}


	}
