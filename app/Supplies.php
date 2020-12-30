<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Supplies extends Model {
		public $table = 'supplies';

		protected $fillable = [

			'Bags',
			'gloves',
			'brooms',
			'rakes',
			'shovels',
			'paint',

		];
	}
