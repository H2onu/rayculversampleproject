<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Nicolaslopezj\Searchable\SearchableTrait;


	class submitProject extends Model {

		public $table = 'project';

		protected $fillable = [

			'project_title',
			'neighborhood',
			'park_rec_fac',
			'comm_cdc_group',
			'comm_cdc_group_name',
			'volunteers_requested',
			'proj_loc_name',
			'proj_loc_street_address',
			'proj_loc_zip',
			'private_property',
			'rally_supplies',
			'proj_description',
			'name',
			'details',

		];


		public function get_record_id( $record ) {

			$proj_id = submitProject::where( 'proj_loc_street_address', $record )->first();

			$proj_id = $proj_id->id;

			return $proj_id;

		}

		use SearchableTrait;

		protected $searchable = [
			'columns' => [
				'project.id' => 3,
				'project.project_title' => 1,
//				'project.proj_description' => 3,
//				'project.proj_loc_street_address' => 2,
				'project.proj_loc_zip' => 2,
			],
//			'joins' => [
//				'profiles' => ['users.id','profiles.user_id'],
//			],
		];

		public function profile()
		{
			return $this->hasOne(submitProject::class);
		}


	}
