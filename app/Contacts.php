<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Contacts extends Model {
		public $table = 'project_contacts';

		protected $fillable = [

			'primary_contact_fname',
			'primary_contact_lname',
			'primary_contact_email',
			'primary_contact_phone',
			'blockCaptain',
			'alternate_contact_fname',
			'alternate_contact_lname',
			'alternate_contact_email',
			'alternate_contact_phone',
			'learn_more_zero_waste',

		];
	}
