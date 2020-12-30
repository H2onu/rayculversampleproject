<?php

	namespace App\Http\Controllers;

	use App\adminEvent;
	use App\Allocation;
	use App\Settings;
	use App\volunteerProject;
	use Auth;
//use Illuminate\Support\Facades\Redirect;
	use App\Contacts;
	use App\Supplies;
	use App\submitProject;
	use App\AIS;
//	use Request;
	use Illuminate\Http\Request;
	use DateTime;
	use Illuminate\Support\Facades\Redirect;
	use phpDocumentor\Reflection\Types\Null_;
	use Validator;
	use Carbon\Carbon;
	use DB;
	use Excel;
	use Image;
	use File;
	use Illuminate\Support\Facades\Input;


	class adminEventController extends Controller {
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */

		public function __construct( Request $request ) {
			$this->middleware( 'auth' );
			$this->adminProject = 'adminEvent';
			$this->request      = $request;
		}

		/**
		 * Show the application dashboard.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index() {

			$user = Auth::user();

			if ( $user->hasPermissionTo( 'View Event Dashboard' ) ) {

				$events = DB::table( 'events' )->get();

				foreach ( $events AS $allocation ) {

					$allocation->imagePath = $this->get_image( $allocation->id );

				}

				return view( 'events.events', compact( 'events' ) );

			} else {

				return view( 'errors/401' );

			}

		}

		public function store( Request $request ) {

			$user = Auth::user();

			if ( $user->hasPermissionTo( 'Add Event' ) ) {

				$input = $request->all();

				adminEvent::create( $input );

				$event = adminEvent::where( 'event_name', $input['event_name'] )->firstOrFail();

				$event_id = $event->id;

				$this->allocation( $event_id, $input );

				return redirect( 'administerEvent' );
			} else {

				return view( 'errors/401' );
			}


		}

		public function edit( $id ) {

			$user = Auth::user();

			if ( $user->hasPermissionTo( 'Edit Event' ) ) {

				$events = adminEvent::FindOrFAil( $id );

				$allocation = Allocation::where( 'event_id', $id )->firstOrFail();

				$block_captain_package = json_decode( $allocation->block_captain_package );

				$events->block_pkg_bags    = $block_captain_package->bags;
				$events->block_pkg_brooms  = $block_captain_package->brooms;
				$events->block_pkg_gloves  = $block_captain_package->gloves;
				$events->block_pkg_rakes   = $block_captain_package->rakes;
				$events->block_pkg_shovels = $block_captain_package->shovels;
				$events->block_pkg_paint   = $block_captain_package->paint;


				$twenty_five_package = json_decode( $allocation->twenty_five_package );

				$events->twenty_five_pkg_bags    = $twenty_five_package->bags;
				$events->twenty_five_pkg_brooms  = $twenty_five_package->brooms;
				$events->twenty_five_pkg_gloves  = $twenty_five_package->gloves;
				$events->twenty_five_pkg_rakes   = $twenty_five_package->rakes;
				$events->twenty_five_pkg_shovels = $twenty_five_package->shovels;
				$events->twenty_five_pkg_paint   = $twenty_five_package->paint;


				$fifty_package = json_decode( $allocation->fifty_package );

				$events->fifty_pkg_bags    = $fifty_package->bags;
				$events->fifty_pkg_brooms  = $fifty_package->brooms;
				$events->fifty_pkg_gloves  = $fifty_package->gloves;
				$events->fifty_pkg_rakes   = $fifty_package->rakes;
				$events->fifty_pkg_shovels = $fifty_package->shovels;
				$events->fifty_pkg_paint   = $fifty_package->paint;


				$one_hundred_package = json_decode( $allocation->one_hundred_package );

				$events->one_hundred_pkg_bags    = $one_hundred_package->bags;
				$events->one_hundred_pkg_brooms  = $one_hundred_package->brooms;
				$events->one_hundred_pkg_gloves  = $one_hundred_package->gloves;
				$events->one_hundred_pkg_rakes   = $one_hundred_package->rakes;
				$events->one_hundred_pkg_shovels = $one_hundred_package->shovels;
				$events->one_hundred_pkg_paint   = $one_hundred_package->paint;

				$over_hundred_package = json_decode( $allocation->over_hundred_package );

				$events->over_hundred_pkg_bags    = $over_hundred_package->bags;
				$events->over_hundred_pkg_brooms  = $over_hundred_package->brooms;
				$events->over_hundred_pkg_gloves  = $over_hundred_package->gloves;
				$events->over_hundred_pkg_rakes   = $over_hundred_package->rakes;
				$events->over_hundred_pkg_shovels = $over_hundred_package->shovels;
				$events->over_hundred_pkg_paint   = $over_hundred_package->paint;

				$voucherOnDate   = Carbon::parse( $events->voucherOnDate );
				$voucherOffDate  = Carbon::parse( $events->voucherOffDate );
				$voucherOverride = $events->voucherOverride;

				$cur_date = $this->check_date();


				if ( $cur_date->between( $voucherOnDate, $voucherOffDate ) != true && $voucherOverride != '1' ) {

					$events->voucherOn = 0;

				} else {

					$events->voucherOn = 1;
				}

				foreach ( $events AS $allocation ) {

					$events['imagePath'] = $this->get_image( $events['id'] );

				}

				return view( 'events.edit', compact( 'events' ) );

			} else {

				return view( 'errors/401' );

			}

		}


		private function dateFormat( $date ) {

			$hi = strtotime( $date );

			return date( "Y-m-d", $hi );


		}

		public function update( $id, Request $request ) {

			$user  = Auth::user();
			$input = Input::all();

			if ( $user->hasPermissionTo( 'Edit Event' ) ) {

				$image = Input::file( 'image' );

				if ( $image != null ) {


					$realPath = $image->getRealPath();
					$name     = $image->getClientOriginalName();
					$ext      = substr( $name, - 4 );
					$path     = $realPath . '/' . $name;

					$image = Image::make( Input::file( 'image' ) );
					File::exists( public_path() . '/images/' ) or File::makeDirectory( public_path() . '/images/' );
					File::exists( public_path() . '/images/events/' ) or File::makeDirectory( public_path() . '/images/events/' );
					File::exists( public_path() . '/images/events/thumbnails/' ) or File::makeDirectory( public_path() . '/images/events/thumbnails/' );

					$image->save( public_path() . '/images/events/' . $user->id . '-' . $id . $ext )
					      ->resize( 50, null, function ( $constraint ) {
						      $constraint->aspectRatio();
					      } )
					      ->save( public_path() . '/images/events/thumbnails/thumb-' . $user->id . '-' . $id . $ext );
				}

				$event = adminEvent::FindorFail( $id );

				$event->event_name                 = $request->event_name;
				$event->projRegFormOnDate          = $this->dateFormat( $request->projRegFormOnDate );
				$event->projRegFormOffDate         = $this->dateFormat( $request->projRegFormOffDate );
				$event->volRegFormOnDate           = $this->dateFormat( $request->volRegFormOnDate );
				$event->volRegFormOffDate          = $this->dateFormat( $request->volRegFormOffDate );
				$event->event_start_date           = $this->dateFormat( $request->event_start_date );
				$event->event_end_date             = $this->dateFormat( $request->event_end_date );
				$event->active                     = $request->active;
				$event->projRegFormOverride        = $request->projRegFormOverride;
				$event->volRegFormOverride         = $request->volRegFormOverride;
				$event->projRegAdminEmail          = $input['projRegAdminEmail'];
				$event->emailPrimaryContact        = $input['emailPrimaryContact'];
				$event->emailProjectOwner          = $input['emailProjectOwner'];
				$event->emailProjectOwnerSubmittal = $input['emailProjectOwnerSubmittal'];
				$event->voucherOnDate              = $input['voucherOnDate'];
				$event->voucherOffDate             = $input['voucherOffDate'];
				$event->voucherOverride            = $input['voucherOverride'];
				$event->event_description          = $input['event_description'];
				$event->supplyPickupLocation       = $input['supplyPickupLocation'];
				$event->supplyPickupLocationDates  = $input['supplyPickupLocationDates'];
				$event->redemptionDetails          = $input['redemptionDetails'];
				$event->allowLogoUpload            = $input['allowLogoUpload'];
				$event->bags                       = $input['bags'];
				$event->gloves                     = $input['gloves'];
				$event->rakes                      = $input['rakes'];
				$event->shovels                    = $input['shovels'];
				$event->brooms                     = $input['brooms'];
				$event->paint                      = $input['paint'];

				$event->save();

				$this->allocation( $id, $input );

				return redirect('administerEvent');

			} else {

				return view( 'errors/401' );

			}


		}

		public function create() {

			$user = Auth::user();

			if ( $user->hasPermissionTo( 'Add Event' ) ) {

				return view( 'events.adminEvent' );

			} else {

				return view( 'errors/401' );
			}

		}

		public function dashboard( $event_id = null ) {

			$total_supplies = $this->supply_calculation( $event_id );

//			echo "<pre>";
//			var_dump( $total_supplies );
//			echo "</pre>";
//			die;

			$user = Auth::user();

			$events = $this->event();

			if ( $user->hasPermissionTo( 'View Event Dashboard' ) ) {

				$event = adminEvent::where( 'id', '=', $event_id )->get()->first();

				$projects = DB::table( 'project' )
				              ->where( 'event_id', $event_id )
				              ->get();

				$active_projects = count( $projects->filter( function ( $active ) {
					return $active->active == 1;
				} ) );

				$pending_projects = count( $projects->filter( function ( $active ) {
					return $active->active == 0;
				} ) );

				$declined_projects = count( $projects->filter( function ( $active ) {
					return $active->active == 2;
				} ) );


				$supplies = $this->project_supplies( $event_id );


				$bags    = '0';
				$gloves  = '0';
				$rakes   = '0';
				$shovels = '0';
				$brooms  = '0';
				$paint   = '0';

				if ( $supplies != 'null' ) {

					$bags    = $supplies->bags;
					$gloves  = $supplies->gloves;
					$rakes   = $supplies->rakes;
					$shovels = $supplies->shovels;
					$brooms  = $supplies->brooms;
					$paint   = $supplies->paint;
				}

				$total_block_captains = $this->block_captain( $event_id );


				if ( $total_block_captains == 'No Data' ) {

					$total_block_captains = '0';

				} else {

					$total_block_captains = count( $total_block_captains );
				}

				$total_event_coordinators = $this->event_coordinator( $event_id );

				if ( $total_event_coordinators == 'No Data' ) {

					$total_event_coordinators = '0';

				} else {

					$total_event_coordinators = count( $total_event_coordinators );
				}

//			$total_volunteers = count( DB::table( 'volunteers' )->where( 'active', '=', '1' )->get() );

				$total_volunteers = $this->project_volunteers( $event_id );

				if ( $total_volunteers == 'No Data' ) {

					$total_volunteers = '0';

				} else {

					$total_volunteers = count( $total_volunteers );
				}

				return view( 'events.dashboard', compact( 'active_projects', 'pending_projects', 'declined_projects',
					'total_block_captains', 'total_volunteers', 'total_event_coordinators', 'events', 'event', 'bags', 'gloves', 'rakes', 'shovels', 'brooms', 'paint', 'events', 'total_supplies' ) );

			} else {

				return view( 'errors/401' );

			}

		}


		public function export( $event_id ) {

			$user = Auth::user();

			if ( $user->hasPermissionTo( 'Print Event Reports' ) ) {

				$export_type = $_GET['type'];


				if ( $export_type == 'active_projects' ) {

					$data = DB::table( 'project' )
					          ->join( 'project_contacts', 'project.id', '=', 'project_contacts.project_id' )
					          ->join( 'users', 'users.id', '=', 'project_contacts.account_owner_id' )
					          ->where( 'project.active', '1' )
					          ->where( 'project.event_id', $event_id )
					          ->select( 'project.*', 'project_contacts.primary_contact_fname', 'project_contacts.primary_contact_lname', 'project_contacts.primary_contact_email', 'project_contacts.primary_contact_phone', 'users.name', 'users.email' )
					          ->get();

					foreach ( $data as $datum => $value ) {

						$neighborhood        = $this->get_neighborhood( $value->neighborhood );
						$value->neighborhood = $neighborhood[0];

					}

				}

				if ( $export_type == 'pending_projects' ) {

					$data = DB::table( 'project' )
					          ->join( 'project_contacts', 'project.id', '=', 'project_contacts.project_id' )
					          ->where( 'active', '0' )
					          ->where( 'event_id', $event_id )
					          ->get();

				}

				if ( $export_type == 'denied_projects' ) {

					$data = DB::table( 'project' )
					          ->where( 'active', '2' )
					          ->where( 'event_id', $event_id )
					          ->get();
				}

				if ( $export_type == 'block_captains' ) {

					$data = $this->block_captain( $event_id );

				}

				if ( $export_type == 'event_coordinators' ) {

					$data = $this->event_coordinator( $event_id );

				}

				if ( $export_type == 'total_volunteers' ) {

					$data = $this->project_volunteers( $event_id );

				}

				if ( $export_type == 'project_packages' ) {

					$data = $this->supply_export( $event_id );

				}

				if ( $export_type == 'voucher_export' ) {

					$data = $this->voucher_email( $event_id );

				}

				$data = $this->toArray( $data );


				Excel::create( $export_type, function ( $excel ) use ( $data ) {

					$excel->sheet( 'Sheetname', function ( $sheet ) use ( $data ) {

						$sheet->fromArray( $data );

					} );

				} )->export( 'csv' );

			} else {

				return view( 'errors/401' );

			}


		}

		private function block_captain( $event_id ) {

			$data = DB::table( 'project_contacts' )
			          ->join( 'project', 'project_contacts.project_id', '=', 'project.id' )
			          ->where( [
				          [ 'project_contacts.block_captain', '=', 'yes' ],
				          [ 'project.active', '=', '1' ],
				          [ 'project.event_id', '=', $event_id ],
			          ] )->get();

			foreach ( $data AS $allocation => $value ) {

				$neighborhood                   = $this->get_neighborhood( $value->neighborhood );
				$captain                        = new \stdClass;
				$captain->user_id               = $value->id;
				$captain->event_id              = $value->event_id;
				$captain->project_id            = $value->project_id;
				$captain->project_title         = $value->project_title;
				$captain->neighborhood          = $neighborhood[0];
				$captain->first_name            = $value->primary_contact_fname;
				$captain->last_name             = $value->primary_contact_lname;
				$captain->email                 = $value->primary_contact_email;
				$captain->phone                 = $value->primary_contact_phone;
				$captain->learn_more_zero_waste = $value->learn_more_zero_waste;
				$captain->created_at            = $value->created_at;

				$array[] = $captain;
			}

			if ( isset( $array ) ) {

				return $array;
			} else {
				return 'No Data';
			}

		}


		private function event_coordinator( $event_id ) {

			$data = DB::table( 'project_contacts' )
			          ->join( 'project', 'project_contacts.project_id', '=', 'project.id' )
			          ->where( [
				          [ 'project_contacts.block_captain', '=', 'no' ],
				          [ 'project.active', '=', '1' ],
				          [ 'project.event_id', '=', $event_id ],
			          ] )->get();


			foreach ( $data AS $allocation => $value ) {

				$neighborhood                              = $this->get_neighborhood( $value->neighborhood );
				$coordinator                               = new \stdClass;
				$coordinator->user_id                      = $value->account_owner_id;
				$coordinator->event_id                     = $value->event_id;
				$coordinator->project_id                   = $value->project_id;
				$coordinator->project_title                = $value->project_title;
				$coordinator->neighborhood                 = $neighborhood[0];
				$coordinator->primary_contact_first_name   = $value->primary_contact_fname;
				$coordinator->primary_contact_last_name    = $value->primary_contact_lname;
				$coordinator->primary_contact_email        = $value->primary_contact_email;
				$coordinator->primary_contact_phone        = $value->primary_contact_phone;
				$coordinator->alternate_contact_first_name = $value->alternate_contact_fname;
				$coordinator->alternate_contact_last_name  = $value->alternate_contact_lname;
				$coordinator->alternate_contact_email      = $value->alternate_contact_email;
				$coordinator->alternate_contact_phone      = $value->alternate_contact_phone;
				$coordinator->voucher_number               = 'PN' . $value->project_id . 'X' . $value->account_owner_id;
				$coordinator->created_at                   = $value->created_at;

				$array[] = $coordinator;
			}

			if ( isset( $array ) ) {

				return $array;
			} else {
				return 'No Data';
			}
		}

		private function project_volunteers( $event_id ) {

			$data = DB::table( 'volunteers' )
			          ->join( 'project', 'volunteers.project_id', '=', 'project.id' )
			          ->where( [
				          [ 'volunteers.active', '=', '1' ],
				          [ 'project.active', '=', '1' ],
				          [ 'project.event_id', '=', $event_id ],
			          ] )
			          ->join( 'users', 'volunteers.user_id', '=', 'users.id' )
			          ->get();


			foreach ( $data AS $allocation => $value ) {

				$neighborhood              = $this->get_neighborhood( $value->neighborhood );
				$volunteers                = new \stdClass;
				$volunteers->user_id       = $value->id;
				$volunteers->event_id      = $value->event_id;
				$volunteers->project_id    = $value->project_id;
				$volunteers->project_title = $value->project_title;
				$volunteers->neighborhood  = $neighborhood[0];
				$volunteers->first_name    = $value->name;
				$volunteers->email         = $value->email;
				$volunteers->created_at    = $value->created_at;

				$array[] = $volunteers;
			}

			if ( isset( $array ) ) {

				return $array;
			} else {
				return 'No Data';
			}

		}

		private function project_supplies( $event_id ) {


			$data = DB::table( 'supplies' )
			          ->join( 'project', 'supplies.project_id', '=', 'project.id' )
			          ->where( [
				          [ 'project.active', '=', '1' ],
				          [ 'project.event_id', '=', $event_id ],
			          ] )
			          ->get();

			if ( ! $data->isEmpty() ) {

				foreach ( $data AS $allocation => $value ) {

					$gloves[]  = $value->gloves;
					$bags[]    = $value->bags;
					$rakes[]   = $value->rakes;
					$brooms[]  = $value->brooms;
					$shovels[] = $value->shovels;
					$paint[]   = $value->paint;

				}

				$supplies = new \stdClass();

				$supplies->gloves  = count( $this->remove_null( $gloves ) );
				$supplies->bags    = count( $this->remove_null( $bags ) );
				$supplies->brooms  = count( $this->remove_null( $brooms ) );
				$supplies->shovels = count( $this->remove_null( $shovels ) );
				$supplies->rakes   = count( $this->remove_null( $rakes ) );
				$supplies->paint   = count( $this->remove_null( $paint ) );

				return $supplies;
			} else {
				return 'null';
			}

		}

		private function voucher_email( $event_id ) {


			$data = DB::table( 'project' )
			          ->join( 'project_contacts', 'project.id', '=', 'project_contacts.project_id' )
			          ->join( 'users', 'users.id', '=', 'project_contacts.account_owner_id' )
			          ->where( 'project.active', '1' )
			          ->where( 'project.event_id', $event_id )
			          ->select( 'project.*', 'project_contacts.primary_contact_fname', 'project_contacts.primary_contact_lname', 'users.name', 'users.email' )
			          ->get();

			foreach ( $data AS $key => $value ) {
				$voucher = new \stdClass();

				$voucher->user_id                      = $value->account_owner_id;
				$voucher->event_id                     = $value->event_id;
				$voucher->project_id                   = $value->project_id;
				$voucher->project_title                = $value->project_title;
				$voucher->primary_contact_first_name   = $value->primary_contact_fname;
				$voucher->primary_contact_last_name    = $value->primary_contact_lname;
				$voucher->primary_contact_email        = $value->primary_contact_email;
				$voucher->primary_contact_phone        = $value->primary_contact_phone;
				$voucher->alternate_contact_first_name = $value->alternate_contact_fname;
				$voucher->alternate_contact_last_name  = $value->alternate_contact_lname;
				$voucher->alternate_contact_email      = $value->alternate_contact_email;
				$voucher->alternate_contact_phone      = $value->alternate_contact_phone;
				$voucher->voucher_number               = 'PN' . $value->project_id . 'X' . $value->account_owner_id;
				$voucher->created_at                   = $value->created_at;

				$array[] = $voucher;

			}

			echo "<pre>";
			var_dump( $array );
			echo "</pre>";
			die;

			return $array;


		}

		function remove_null( $array ) {

			foreach ( $array as $index => $value ) {
				if ( $value === null ) {
					unset( $array[ $index ] );
				}
			}

			return $array;

		}


		private function get_neighborhood( $neighborhood_id ) {

			$neighborhood = DB::table( 'neighborhood' )->where( 'id', $neighborhood_id )->pluck( 'neighborhood' );

			return $neighborhood;
		}

		private function toArray( $data ) {

			$data = collect( $data )->map( function ( $x ) {
				return (array) $x;
			} )->toArray();

			return $data;


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

		private function event() {

			$event_id = $this->request->segment( 1 );

			$event = adminEvent::where( 'id', $event_id )->first();

			return $event;


		}

		private function check_date() {

			$cur_date = Carbon::now();

			return $cur_date;

		}

		private function allocation( $id, $input ) {


//			$allocation = Allocation::Where( 'event_id', $id )->firstOrFail();
			$allocation = new Allocation();

			$block_captain_package =
				array(

					'bags'    => $input['block_pkg_bags'],
					'brooms'  => $input['block_pkg_brooms'],
					'gloves'  => $input['block_pkg_gloves'],
					'rakes'   => $input['block_pkg_rakes'],
					'shovels' => $input['block_pkg_shovels'],
					'paint'   => $input['block_pkg_paint'],

				);

			$twenty_five_package = array(
				'bags'    => $input['twenty_five_pkg_bags'],
				'brooms'  => $input['twenty_five_pkg_brooms'],
				'gloves'  => $input['twenty_five_pkg_gloves'],
				'rakes'   => $input['twenty_five_pkg_rakes'],
				'shovels' => $input['twenty_five_pkg_shovels'],
				'paint'   => $input['twenty_five_pkg_paint'],

			);

			$fifty_package = array(
				'bags'    => $input['fifty_pkg_bags'],
				'brooms'  => $input['fifty_pkg_brooms'],
				'gloves'  => $input['fifty_pkg_gloves'],
				'rakes'   => $input['fifty_pkg_rakes'],
				'shovels' => $input['fifty_pkg_shovels'],
				'paint'   => $input['fifty_pkg_paint'],

			);

			$one_hundred_package = array(
				'bags'    => $input['one_hundred_pkg_bags'],
				'brooms'  => $input['one_hundred_pkg_brooms'],
				'gloves'  => $input['one_hundred_pkg_gloves'],
				'rakes'   => $input['one_hundred_pkg_rakes'],
				'shovels' => $input['one_hundred_pkg_shovels'],
				'paint'   => $input['one_hundred_pkg_paint'],

			);

			$over_hundred_package = array(
				'bags'    => $input['over_hundred_pkg_bags'],
				'brooms'  => $input['over_hundred_pkg_brooms'],
				'gloves'  => $input['over_hundred_pkg_gloves'],
				'rakes'   => $input['over_hundred_pkg_rakes'],
				'shovels' => $input['over_hundred_pkg_shovels'],
				'paint'   => $input['over_hundred_pkg_paint'],

			);

			$allocation->event_id              = $id;
			$allocation->block_captain_package = json_encode( $block_captain_package );
			$allocation->twenty_five_package   = json_encode( $twenty_five_package );
			$allocation->fifty_package         = json_encode( $fifty_package );
			$allocation->one_hundred_package   = json_encode( $one_hundred_package );
			$allocation->over_hundred_package  = json_encode( $over_hundred_package );

			$allocation->save();
		}


		private function supply_calculation( $id ) {

			$callers = debug_backtrace();
			foreach ( $callers as $call ) {

				if ( $call['function'] == 'supply_export' ) {

					$calling_function = $call['function'];
				}

			}

			/*@Ray -> Looping though and summing up each project's volunteers into an array*/
			$total_supplies = new \stdClass();

			$projects = submitProject::where( 'active', 1 )->pluck( 'id' );

			foreach ( $projects AS $key => $proj_id ) {

				$volunteer_count = volunteerProject::where( 'project_id', $proj_id )->count();

				$volunteer_tier = $this->vol_allocation( $volunteer_count, $id );

				$supplies = json_decode( $volunteer_tier->supplies );

				$package_count[]                  = $volunteer_tier->package;
				$bags_array[]                     = $supplies->bags;
				$brooms_array[]                   = $supplies->brooms;
				$gloves_array[]                   = $supplies->gloves;
				$rakes_array[]                    = $supplies->rakes;
				$shovels_array[]                  = $supplies->shovels;
				$paint_array[]                    = $supplies->paint;
				$tier[ $volunteer_tier->package ] = $volunteer_tier;


				if ( isset( $calling_function ) ) {

					if ( $calling_function == "supply_export" ) {

						$project_title         = submitProject::where( 'id', $proj_id )->value( 'project_title' );
						$account_owner_id      = Contacts::where( 'id', $proj_id )->value( 'account_owner_id' );
						$primary_contact_fname = Contacts::where( 'id', $proj_id )->value( 'primary_contact_fname' );
						$primary_contact_lname = Contacts::where( 'id', $proj_id )->value( 'primary_contact_lname' );
						$primary_contact_email = Contacts::where( 'id', $proj_id )->value( 'primary_contact_email' );

						$data                         = new \stdClass();
						$data->project_id             = $proj_id;
						$data->account_owner_id       = $account_owner_id;
						$data->project_voucher_number = 'PN' . $data->project_id . 'X' . $data->account_owner_id;
						$data->project_title          = $project_title;

						$data->primary_contact_fname = $primary_contact_fname;
						$data->primary_contact_lname = $primary_contact_lname;
						$data->primary_contact_email = $primary_contact_email;

						$data->volunteer_count = $volunteer_count;
						$data->tier            = $volunteer_tier->package;
						$data->bags            = $supplies->bags;
						$data->brooms          = $supplies->brooms;
						$data->gloves          = $supplies->gloves;
						$data->rakes           = $supplies->rakes;
						$data->shovels         = $supplies->shovels;
						$data->paint           = $supplies->paint;

						$array[] = $data;

					}
				}

			}
			if ( isset( $calling_function ) ) {
				if ( $calling_function == "supply_export" ) {

					return $array;
					exit;
				}
			}


			$package_count = array_count_values( $package_count );

			foreach ( $package_count as $item => $value ) {

				if ( array_key_exists( $item, $tier ) ) {

					$tier[ $item ]->supplies = json_decode( $tier[ $item ]->supplies );

					$tier[ $item ]->count = $value;

				}
			}

			$total_supplies->total_bags    = array_sum( $bags_array );
			$total_supplies->total_brooms  = array_sum( $brooms_array );
			$total_supplies->total_gloves  = array_sum( $gloves_array );
			$total_supplies->total_rakes   = array_sum( $rakes_array );
			$total_supplies->total_shovels = array_sum( $shovels_array );
			$total_supplies->total_paint   = array_sum( $paint_array );
			$total_supplies->tiers         = $tier;

			return $total_supplies;

		}


//		/*@RAY - Block Captain Calculation is based on Sum of Block Captains. This is different than the volunteers driven calculation */
//		private function block_captain_supply_calculation( $id ) {
//			$block_captain_totals                = new \stdClass();
//			$block_captain_count_array = Contacts::where( 'block_captain', 'yes' )->get()->toArray();
//
//
//			if ( ! empty ( $block_captain_count_array ) ) {
//
//				$allocation = Allocation::Where( 'event_id', $id )->firstOrFail()->toArray();
//
//				$block_captain_count = count( $block_captain_count_array );
//
//				foreach ( $block_captain_count_array AS $key ) {
//
//					$volunteers = volunteerProject::where( 'project_id', $key->project_id )->count();
//
//					/*Use This For Dyanmic Packages*/
//					$block_captain_tier = (object) $this->vol_allocation( $volunteers, $id )['package'];
//
//					/*Total Allocation Array: Use this to add  block captain package to tiers.*/
//					$block_captain_package[ $key->project_id ] = (array) json_decode( $allocation[ $block_captain_tier->scalar ] );
//
//				}
//
//				foreach ( $block_captain_package as $item => $value ) {
//
//					$bags_array[]    = $value['bags'];
//					$brooms_array[]  = $value['brooms'];
//					$gloves_array[]  = $value['gloves'];
//					$rakes_array[]   = $value['rakes'];
//					$shovels_array[] = $value['shovels'];
//					$paint_array[]   = $value['paint'];
//
//				}
//
//				$block_captain_totals->total_bags    = array_sum( $bags_array );
//				$block_captain_totals->total_brooms  = array_sum( $brooms_array );
//				$block_captain_totals->total_gloves  = array_sum( $gloves_array );
//				$block_captain_totals->total_rakes   = array_sum( $rakes_array );
//				$block_captain_totals->total_shovels = array_sum( $shovels_array );
//				$block_captain_totals->total_paint   = array_sum( $paint_array );
//
//				/*@Ray -> Each block captain recieves the block captain package */
//				$block_captain_totals->total_block_captains         = $block_captain_count;
//				$block_captain_totals->total_block_captain_packages = $block_captain_package;
//
//			}
//
//			return $block_captain_totals;
//
//		}


		private function vol_allocation( $volunteers, $id ) {

			if ( $volunteers <= 25 ) {

				$package = 'twenty_five_package';
				$count   = + 1;

			} elseif ( $volunteers >= 26 && $volunteers <= 50 ) {

				$package = 'fifty_package';

			} elseif ( $volunteers >= 51 && $volunteers <= 100 ) {

				$package = 'one_hundred_package';
			} else {

				$package = 'over_hundred_package';
			}

			$allocation = Allocation::where( 'event_id', $id )->value( $package );

			$result           = new \stdClass();
			$result->supplies = $allocation;
			$result->package  = $package;

			return $result;

		}

		private function supply_export( $id ) {

			$projects = $this->supply_calculation( $id );

			return $projects;


		}


	}
