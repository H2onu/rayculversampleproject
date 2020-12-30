<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Allocation extends Model {

		public $table = 'allocations';

		protected $fillable = [

			'block_captain_package',
			'twenty_five_package',
			'fifty_package',
			'one_hundred_package',
			'over_hundred_package',

		];
	}
