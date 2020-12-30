<?php

	namespace App\Http\Controllers;

//	use Request;
	use Illuminate\Http\Request;
	use App\submitProject;
	use App\volunteerProject;
	use App\Neighborhood;
	use App\adminEvent;
	use App\Contacts;
	use Auth;
	use Illuminate\Support\Facades\App;
	use Illuminate\Support\Facades\Redirect;
	use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
	use DB;
	use App\PDF;
	use Carbon\Carbon;
	use phpDocumentor\Reflection\Types\Null_;
	use Illuminate\Contracts\Foundation\Application;
	use Share;


	class volunteerProjectController extends Controller {
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */


		public function __construct( Request $request ) {
			$this->middleware( 'auth' );
			$this->volunteerProject = 'volunteerProject';
			$this->request          = $request;
		}

		/**
		 * Show the application dashboard.
		 *
		 * @return \Illuminate\Http\Response
		 */

		public function index( $event_id = null, $user_id = null, $neighborhood_id = null, $project_id = null ) {

			$event_id = $this->request->segment( 1 );

			if ( ! is_numeric( $event_id ) ) {

				return view( 'errors.401' );
			}

			$event = adminEvent::find( $event_id );

			$cur_date = $this->check_date();

			$volformondate   = Carbon::parse( $event->volRegFormOnDate );
			$volformoffdate  = Carbon::parse( $event->volRegFormOffDate );
			$volFormOverride = $event->volRegFormOverride;

			$voucherOnDate   = Carbon::parse( $event->voucherOnDate );
			$voucherOffDate  = Carbon::parse( $event->voucherOffDate );
			$voucherOverride = $event->voucherOverride;

			if ( $cur_date->between( $voucherOnDate, $voucherOffDate ) != true && $voucherOverride != '1' ) {

				$event->voucherOn = 0;

			} else {

				$event->voucherOn = 1;
			}

			if ( $cur_date->between( $volformondate, $volformoffdate ) != true && $volFormOverride != '1' ) {

				return view( 'partials.comingsoon' )->with( array( 'events' => $event ) );

			} else {

				$filter_name = "All Projects";

				$neighborhood = Neighborhood::pluck( 'neighborhood', 'id' );

				$project_table = submitProject::where( 'active', '1' )->where( 'event_id', $event_id )->paginate( 10 );

				foreach ( $project_table AS $key ) {

					$key->imagePath = $this->get_image( $key->id );

					$volunteers_registered = $this->volunteers( $event_id, $key->id );

					$key->volunteers_registered = count( $volunteers_registered );

					$key->available_slots = ( $key->volunteers_requested - $key->volunteers_registered );

					$key->neighborhood = $neighborhood[ $key->neighborhood ];

				}

				if ( $user_id != null ) {

					$project_table = submitProject::where( 'active', '1' )->where( 'event_id', $event_id )->where( 'account_owner_id', $user_id )->paginate( 10 );

					$filter_name = 'My Projects';

					foreach ( $project_table AS $key ) {

						$key->imagePath = $this->get_image( $key->id );

						$volunteers_registered = $this->volunteers( $event_id, $key->id );

						$key->volunteers_registered = count( $volunteers_registered );

						$key->available_slots = ( $key->volunteers_requested - $key->volunteers_registered );

						$key->neighborhood = $neighborhood[ $key->neighborhood ];

					}
				}

				if ( $neighborhood_id != null ) {

					$project_table = submitProject::where( 'active', '1' )
					                              ->where( 'event_id', $event_id )
					                              ->where( 'neighborhood', $neighborhood_id )
					                              ->paginate( 10 );


					$neighborhood_name = DB::table( 'neighborhood' )->where( 'id', $neighborhood_id )->first();

					$filter_name = $neighborhood_name->neighborhood;

					foreach ( $project_table AS $key ) {

						$key->imagePath = $this->get_image( $key->id );

						$volunteers_registered = $this->volunteers( $event_id, $key->id );

						$key->volunteers_registered = count( $volunteers_registered );

						$key->available_slots = ( $key->volunteers_requested - $key->volunteers_registered );

						$key->neighborhood_id = $key->neighborhood;

						$key->neighborhood = $neighborhood[ $key->neighborhood ];


					}

				}

				if ( $project_id != null ) {

					$project_table = submitProject::where( 'active', '1' )
					                              ->where( 'id', $project_id )
					                              ->paginate( 10 );

					foreach ( $project_table AS $key ) {

						$key->imagePath = $this->get_image( $key->id );

						$volunteers_registered = $this->volunteers( $event_id, $key->id );

						$key->volunteers_registered = count( $volunteers_registered );

						$key->available_slots = ( $key->volunteers_requested - $key->volunteers_registered );

						$key->neighborhood_id = $key->neighborhood;

						$key->neighborhood = $neighborhood[ $key->neighborhood ];


					}

				}

				$user_id = Auth::user()->id;

				$volunteered_projects = DB::table( 'volunteers' )->where( 'user_id', $user_id )->get();

				$tmp = $volunteered_projects;

				if ( ! empty( $tmp[0] ) ) {

					$active_project_ids = array();

					foreach ( $volunteered_projects AS $key => $value ) {

						if ( $value->active == '1' ) {

							$active_project_ids[] = $value->project_id;

						}

					}

					$active_project_ids = array_unique( $active_project_ids );

					foreach ( $active_project_ids AS $active_project_id ) {

						foreach ( $project_table As $project => $project_array ) {

							if ( $project_array->id == $active_project_id ) {

								$project_array->volactive = '1';
							}

						}
					}

				}

				$icons = [
					'https://support.xbox.com/Content/Images/live_status_active_icon.png',
					'http://www.cityofukiah.com/NewWeb/wp-content/themes/deepblue/images/icon-dollar-small.png',
					'http://h30434.www3.hp.com/html/assets/comm_alert_icon.png',
					'https://i.stack.imgur.com/1luXA.png',
					'https://d30fqisedfc4ds.cloudfront.net/rensupv1/images/rss-icon.png',
				];

				Mapper::map( 39.9525839, - 75.16522150000003, [
					'zoom'              => 10,
					'fullscreenControl' => false,
					'center'            => true,
					'marker'            => false,
					'cluster'           => true,
					'clusters'          => [
						'center' => false,
						'zoom'   => 15,
						'size'   => 4,
					],
					'language'          => 'en',
				] );


				foreach ( $project_table AS $map_key ) {

					if ( $map_key->active == 1 ) {

						$lat          = $map_key->projLat;
						$long         = $map_key->projLong;
						$proj_title   = $map_key->project_title;
						$proj_address = $map_key->proj_loc_street_address;

						Mapper::informationWindow(
							$lat,
							$long,
							'<div class="infowin"><h1 style="color: deepskyblue">' . $proj_title . '</h1><p style="color: limegreen"><strong>' . $proj_address . '</strong></p></div>',
							[
								'title'     => $proj_title,
								'animation' => 'DROP',

							]
						);

					}
				}

				$event->social = $this->social();

				return view( 'forms.volunteerProject' )->with( array(
					'events'               => $event,
					'projects'             => $project_table,
					'volunteered_projects' => $volunteered_projects,
					'neighborhood'         => $neighborhood,
					'filter_name'          => $filter_name,
					'neighborhood_id'      => $neighborhood_id,
				) );

			}
		}

		public
		function edit(
			$event_id, $request
		) {

			/* Get the referring url segment so that the redirect can go back to either the 'my projects' filter or 'all projects filter' */

			$url_segment = $this->get_referring_url();

			$projects = DB::table( 'project' )->get();

			$project_array = $projects->filter( function ( $project_id ) use ( $request ) {

				return $project_id->id == $request;

			} )->first();

			$neighborhood_id      = $project_array->neighborhood;
			$user_id              = Auth::user()->id;
			$volunteered_projects = DB::table( 'volunteers' )->where( 'user_id', $user_id )->get();

			if ( is_object( $volunteered_projects ) && ( count( get_object_vars( $volunteered_projects ) ) > 0 ) ) {

				$volunteered_projects = $this->get_volunteered_projects( $volunteered_projects, $user_id );

			}

			/* Activate Volunteer */

//			$volunteer             = new volunteerProject();


			$volunteer             = volunteerProject::updateOrCreate( [
				'project_id' => $request,
				'user_id'    => $user_id,
			], [ 'project_id' => $request, 'user_id' => $user_id, 'active' => '1' ] );
			$volunteer->project_id = $request;
			$volunteer->user_id    = $user_id;
			$volunteer->active     = '1';
			$volunteer->save();


			if ( array_key_exists( 4, $url_segment ) ) {


				if ( isset( $url_segment[4] ) && $url_segment[4] == 'my-projects' ) {

					return redirect()->route( 'my-projects', [ $user_id ] );

				}

				if ( isset( $url_segment[4] ) && $url_segment[4] == 'neighborhood?' || $url_segment[4] == 'neighborhood' ) {

					return redirect()->route( 'neighborhood', [ $neighborhood_id ] );

				}

				if ( isset( $url_segment[4] ) && $url_segment[4] == 'volunteerProject' ) {

					return redirect()->route( 'volunteerProject.index', [ $url_segment[3] ] );

				}

			}

			if ( ! array_key_exists( 4, $url_segment ) ) {

				return redirect()->route( 'volunteerProject.index', [ $url_segment[3] ] );

			}


		}

		public function destroy( $event_id, $request ) {

			$url_segment = $this->get_referring_url();

			$volunteer             = new volunteerProject();
			$volunteer->project_id = $request;
			$user_id               = Auth::user()->id;
			$volunteer->user_id    = $user_id;
			$volunteer->active     = '2';

			volunteerProject::where( [
				'user_id'    => $user_id,
				'project_id' => $request,
			] )->update( array( 'active' => '2' ) );

			$projects = DB::table( 'project' )->get();

			$project_array = $projects->filter( function ( $project_id ) use ( $request ) {

				return $project_id->id == $request;

			} )->first();

			$neighborhood_id = $project_array->neighborhood;

			$path = parse_url( $url_segment[4] );

			$url_segment[4] = $path['path'];

			if ( array_key_exists( 4, $url_segment ) ) {


				if ( isset( $url_segment[4] ) ) {

					if ( isset( $url_segment[4] ) && $url_segment[4] == 'my-projects' ) {

						return redirect()->route( 'my-projects', [ $user_id ] );

					}
				}

				if ( isset( $url_segment[4] ) && $url_segment[4] == 'neighborhood' ) {

					return redirect()->route( 'neighborhood', [ $neighborhood_id ] );

				}

				if ( isset( $url_segment[4] ) && $url_segment[4] == 'volunteerProject' ) {

					return redirect()->route( 'volunteerProject.index', [ $url_segment[3] ] );

				}

			}
			if ( ! array_key_exists( 4, $url_segment ) ) {

				return redirect()->route( 'volunteerProject.index' );

			}


		}

		private
		function get_volunteered_projects(
			$volunteered_projects, $user_id
		) {


			if ( is_object( $volunteered_projects ) && ( count( get_object_vars( $volunteered_projects ) ) > 0 ) ) {

				foreach ( $volunteered_projects AS $key => $value ) {

					$project_id[] = $value->project_id;

				}

				$volunteered_project_ids = array_unique( $project_id );

			} else {

				$volunteered_project_ids = '';
			}

			return $volunteered_project_ids;

		}

		function get_referring_url() {

			$url_segment = \Request::path();
			$url_segment = \Request::server( 'HTTP_REFERER' );
			$url_segment = explode( '/', $url_segment );

			return $url_segment;

		}

		function neighborhood( Request $request ) {

			$neighborhood = $request->neighborhood;

			$event_id = $this->request->segment( 1 );

			echo $this->index( $event_id, $user_id = null, $neighborhood );


		}


		public
		function voucher(
			$project_id
		) {

			$pdf = new PDF\PDF( 'L' );

			$title = ' Spring  up 2018';

			$voucher = $pdf->get_data( $project_id );

			$text0 = $voucher['primary_first_name'].' '. $voucher['primary_last_name'];

			$text1 = 'THIS IS YOUR GENERAL SUPPLY VOUCHER';

			$text2 = 'REDEMPTION DETAILS';

			$text3 = $voucher['redemptionDetails'];

			$text4 = "PROJECT ID:  " . strtoupper($voucher['pin']);

			$text5 = 'SUPPLY PICKUP LOCATION';

			$text6 = $voucher['supplyPickupLocation'];

			$text7 = 'DATES & TIMES';

			$text8 = $voucher['supplyPickupLocationDates'];


			$pdf->SetTitle( $title );

			$pdf->PrintChapter( 1, $voucher['projEventTitle'], $text0, $text1, $text2, $text3, $text4, $text5, $text6, $text7, $text8 );

			$pdf->Output();

		}

		public function volunteers( $event_id, $project_id ) {

			$call = debug_backtrace()[1]['function'];

			$events = $this->event();

			$project = DB::table( 'project' )->where( 'id', $project_id )->get()->first();

			$volunteers = DB::table( 'volunteers' )
			                ->where( [ [ 'project_id', '=', $project_id ], [ 'active', '=', '1' ] ] )
			                ->Join( 'users', 'volunteers.user_id', '=', 'users.id' )
			                ->select( 'users.name', 'users.email', 'volunteers.active', 'volunteers.created_at as vCreated_at' )
			                ->get();

			if ( $call == 'index' ) {

				return $volunteers;
				exit;
			} else {

				return view( 'reports.volunteers', compact( [ 'volunteers', 'project', 'events' ] ) );

			}

		}

		private function get_image( $id ) {

			$uid                  = Auth::user();
			$project['uid']       = $uid->id;
			$project['imageName'] = $uid->id . '-' . $id;
			$imageName            = glob( public_path() . '/images/project/' . $project['imageName'] . '.*' );

			if ( ! empty( $imageName[0] ) ) {

				$project['imagePath'] = basename( $imageName[0] );

				return $project['imagePath'];
			}

		}

		private function check_date() {

			$cur_date = Carbon::now();

			return $cur_date;


		}

		private function event() {

			$event_id = $this->request->segment( 1 );

			$event = adminEvent::where( 'id', $event_id )->first();

			return $event;


		}

		public function social() {

			$event = $this->event();

			$links = Share::page( 'http://www..com/-spring-up/', $event->event_name )
			              ->facebook()
			              ->twitter()
			              ->googlePlus()
			              ->linkedin( 'Extra linkedin summary can be passed here' );

			return $links;

		}

		public function get() {

			$query = $this->request->query;

			$query = $query->get( 'q' );

			$users = $query

				? submitProject::where( 'email', 'LIKE', "%$query%" )->paginate( 15 )

				: User::paginate( 15 );


			return \View::make( 'users.index' )->withUsers( $users );

		}


		public function sampleForm() {
			return view( 'test2' );
		}

		public function ajaxData( Request $request ) {

			return submitProject::search( $request->get( 'q' ) )->get();

		}

		public function find( Request $request ) {

			return User::search( $request->get( 'q' ) )->with( 'profile' )->get();
		}


		public function show( Request $request ) {

			$project_number = $request->segment( 3 );

			return $this->index( 1, '', '', $project_number );

		}


	}