<?php

	namespace App\Http\Controllers;

	use App\User;
	use DB;
	use Illuminate\Http\Request;
	use Usercontorller;
	use Spatie\Permission\Models\Role;
	use Spatie\Permission\Models\Permission;
	use Auth;


	class oldDatabasePWEncrypter extends Controller {

		function index() {

			$admin = Auth::user();

			if ( $admin->hasRole( 'Admin' ) ) {

				$users = DB::table( 'tblRegistrants' )->get();


				foreach ( $users As $key => $val ) {


					$password = bcrypt( $val->regPassword );
					$name     = $val->regFirstName;
					$email    = $val->regEmail;

					DB::table( 'users' )->insert( [
						'name'     => $name,
						'email'    => $email,
						'password' => $password,
					] );

					echo $val->regPassword . '<br>' . $val->regEmail . '<br><br><br>';


				}
			} else {

				return view( 'errors/401' );

			}
		}

		public function assign_role() {

			$admin = AUTH::user();

			if ( $admin->hasRole( 'Admin' ) ) {

				$u = $this->user();

				foreach ( $u AS $k => $value ) {

					if ( $value->email == '@.com' ) {

						if ( $value->hasRole( 'Admin' ) ) {

						} else {

							$value->assignRole( 'Admin' );

						}
					} else {

						$value->assignRole( 'Project Owner' );

						echo 'ASSIGNED: ' . $value->email . "<br>";

					}
				}

			} else {

				return view( 'errors/401' );

			}

		}

		private function user() {

			$users_table = User::all();

			return $users_table;
		}

	}
