<?php
	use Intervention\Image\Facades\Image;
	use App\adminEvent;
	use App\submitProject;
	use App\User;
	use App\Http\Controllers\adminEventController;


	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the RouteServiceProvider within a group which
	| contains the "web" middleware group. Now create something great!
	|
	*/

	Route::get( 'test', function () {

		if ( request()->has( 'name' ) ) {

			$users = submitProject::where( 'neighborhood', request( 'name' ) )
			                      ->paginate( 1 )
			                      ->appends( 'name', request( 'name' ) );
		} else {

			$users = submitProject::paginate( 2 );

		}

		return view( 'test' )->with( 'users', $users );

	} );

	Route::get( '/', 'HomeController@home');

	Auth::routes();

	Route::get( '/{event}/home', 'HomeController@index' )->name('event-home');

	Route::resource( '{event_id}/volunteerProject', 'volunteerProjectController' );

	Route::get('voucher' , 'SocialController@voucher')->name('voucher');

	Route::get( 'volunteerProject/voucher/{project_id}', 'volunteerProjectController@voucher' )->name( 'volunteerProject.voucher' );

	Route::post( '{event_id}/volunteerProject/{project_id}', 'volunteerProjectController@show' )->name('project');

	Route::get( '{event_id}/volunteerProject/my-projects/{user_id}', 'volunteerProjectController@index' )->name( 'my-projects' );

	Route::get( '{event_id}/volunteerProject/my-volunteers/{project_id}', 'volunteerProjectController@volunteers' )->name( 'my-volunteers' );

	Route::get( '{event_id}/volunteerProject/neighborhood/{neighborhood}', 'volunteerProjectController@neighborhood' )->name( 'neighborhood' );

	Route::post( '{event_id}/volunteerProject/neighborhood/{neighborhood}', 'volunteerProjectController@neighborhood' )->name( 'neighborhood2' );

// ##SUBMIt PROJECT
	Route::get( '/{event_id}/submitProject/{project_id}/edit', 'submitProjectController@edit' )->name( 'projectEdit' );

	Route::get( '/{event_id}/submitProject/{project_id?}/update', 'submitProjectController@update' )->name( 'projectUpdate' );

	Route::get( '/{event_id}/submitProject/', 'submitProjectController@index' )->name( 'submitProject' );

	Route::get( '/{event_id}/submitProject/shortForm', 'submitProjectController@shortForm' )->name( 'submitProject.shortForm' );

	Route::resource( '{event_id?}/submitProject', 'submitProjectController' );

	Route::get( '/submitProject/activate/{event_id?}', 'submitProjectController@activate' );

	Route::post( '/submitProject/decline', 'submitProjectController@decline' );


// ##ADMIN EVENT
	Route::get( 'adminProject', 'submitProjectController@adminProject' );

	Route::get( '{event_id}/adminProject/', 'submitProjectController@adminProject' )->name( 'adminProject' );


	Route::get( '{event_id}/administerEvent', 'adminEventController@index' )->name( 'administerEvent' );

	Route::resource( 'administerEvent', 'adminEventController' );



	Route::get( '{event_id}/dashboard', 'adminEventController@dashboard' )->name( 'event-dashboard' );

	Route::get( 'events/exports/{data}', 'adminEventController@export' )->name( 'export-projects' );

	//Permissions & Roles

	Route::resource( 'users', 'UserController' );

	Route::get( 'users', 'UserController@get' );

	Route::resource( 'roles', 'RoleController' );

	Route::resource( 'permissions', 'PermissionsController' );


	/* Autocomplete */

	Route::get( 'test2', array( 'as'   => 'typeahead.search',
	                                       'uses' => 'volunteerProjectController@sampleForm',
	) );


	Route::get('autocomplete-search',array('as'=>'autocomplete.search','uses'=>'volunteerProjectController@index'));

	Route::get('find',array('as'=>'autocomplete.ajax','uses'=>'volunteerProjectController@ajaxData'));









