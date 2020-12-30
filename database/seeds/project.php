<?php

	use Illuminate\Database\Seeder;
	use Carbon\Carbon;


	class project extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run() {

			DB::table( 'project' )->insert( [
				'event_id'                => ( '1' ),
				'active'                  => ( 1 ),
				'project_title'           => ( ' Spring up' ),
				'account_owner_id'        => ( '1' ),
				'neighborhood'            => ( '1' ),
				'park_rec_fac'            => str_random( 10 ),
				'comm_cdc_group'          => str_random( 10 ),
				'comm_cdc_group_name'     => str_random( 10 ),
				'volunteers_requested'    => str_random( 10 ),
				'proj_loc_name'           => str_random( 10 ),
				'proj_loc_street_address' => str_random( 10 ),
				'proj_loc_zip'            => str_random( 10 ),
				'private_property'        => str_random( 10 ),
				'projLat'                 => '39.9525839',
				'projLong'                => '- 75.16522150000003',
				'created_at'              => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'              => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			$project_id = DB::table( 'project' )->select( 'id' )->orderby( 'id', 'desc' )->first();

			DB::table( 'project_contacts' )->insert( [
				'project_id'            => ( $project_id->id ),
				'account_owner_id'      => ( '1' ),
				'primary_contact_fname' => str_random( 10 ),
				'primary_contact_lname' => str_random( 10 ),
				'primary_contact_email' => str_random( 10 ) . '@gmail.com',
				'primary_contact_phone' => str_random( 10 ),
				'created_at'            => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'            => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'supplies' )->insert( [
				'project_id' => ( $project_id->id ),
				'bags'       => ( '1' ),
				'gloves'     => ( '1' ),
				'brooms'     => ( '1' ),
				'rakes'      => ( '1' ),
				'shovels'    => ( '1' ),
				'paint'      => ( '1' ),
				'created_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at' => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );

			DB::table( 'events' )->insert( [
				'event_name'         => str_random( 10 ),
				'event_start_date'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'event_end_date'     => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'projRegFormOnDate'  => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'projRegFormOffDate' => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'volRegFormOnDate'   => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'volRegFormOffDate'  => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'voucherOnDate'      => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'voucherOffDate'     => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'active'             => ( '1' ),
				'created_at'         => Carbon::now()->format( 'Y-m-d H:i:s' ),
				'updated_at'         => Carbon::now()->format( 'Y-m-d H:i:s' ),

			] );


		}
	}

