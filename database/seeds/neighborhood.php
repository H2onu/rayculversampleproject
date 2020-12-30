<?php

	use Illuminate\Database\Seeder;
	use Carbon\Carbon;

	class neighborhood extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Select',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Center City',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Near Northeast ',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Far Northeast ',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Germantown/Chestnut Hill',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Kensington',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Mt. Airy/East Falls',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'North ',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Olney/Oak',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Roxborough',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'South ',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'Southwest ',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'neighborhood' )->insert( [

				'neighborhood' => 'West ',
				'created_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'   => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );


		}
	}
