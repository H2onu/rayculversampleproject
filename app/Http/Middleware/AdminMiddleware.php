<?php

	namespace App\Http\Middleware;

	use Closure;
	use Illuminate\Support\Facades\Auth;
	use App\User;
	use DB;

	class AdminMiddleware {
		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \Closure                 $next
		 *
		 * @return mixed
		 */
		public function handle( $request, Closure $next ) {

			$roles = DB::table( 'model_has_roles' )->get();

			/*Add Admin Role to first user*/
			if ( empty( $roles[0] ) ) {
				$admin = User::find( '1' );
				$admin->assignRole( 'Admin' );
			}

			$user = User::all()->count();

			if ( ! ( $user == 1 ) ) {
				if ( ! Auth::user()->hasPermissionTo( 'Administer roles & permissions' ) ) //If user does //not have this permission
				{
					abort( '401' );
				}
			}

			return $next( $request );
		}
	}