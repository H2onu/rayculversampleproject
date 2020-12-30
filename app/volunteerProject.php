<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class volunteerProject extends Model
{
	public $table = 'volunteers';

	protected $fillable = [

		'neighborhood',
		'user_id',
		'project_id',
		'active'
];

	public function index() {


		return view( 'forms.volunteerProject' );


	}


}
