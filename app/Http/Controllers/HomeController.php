<?php

	namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use App\adminEvent;
	use Illuminate\Support\Facades\Auth;

	class HomeController extends Controller {
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct( Request $request ) {
			$this->middleware( 'auth' );
			$this->request = $request;
		}

		/**
		 * Show the application dashboard.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index() {

			$event_id = $this->request->segment( 1 );

			$events = adminEvent::where( 'id', $event_id )->first();

			if ( $events->active == '1' ) {

				return view( 'home' )->with( compact( 'events' ) );

			} else {

				$denied = 'deny';

				return view( 'errors/401' )->with( compact( 'denied' ) );
			}

		}

		public function home() {

			$events = adminEvent::where( 'active', '1' )->get();

			foreach ( $events AS $allocation ) {

				$allocation->imagePath = $this->get_event_image( $allocation->id );

			}

			return view( 'welcome', compact( 'events' ) );



		}

		private function get_event_image( $id ) {

			$uid                  = Auth::user();
			$project['uid']       = $uid->id;
			$project['imageName'] = $uid->id . '-' . $id;

			$imageName            = glob( public_path() . '/images/events/' . '*-'.$id . '.jpg' );

			if ( ! empty( $imageName[0] ) ) {

				$project['imagePath'] = basename( $imageName[0] );

				return $project['imagePath'];
			}

		}

	}
