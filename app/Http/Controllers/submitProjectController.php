<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	//use Illuminate\Support\Facades\Redirect;
	use App\Contacts;
	use App\Supplies;
	use App\submitProject;
	use App\Neighborhood;
	use App\adminEvent;
	use App\AIS;
	use Auth;
//	use Request;
	use DateTime;
	use Illuminate\Support\Facades\Input;
	use Illuminate\Support\Facades\Redirect;
	use Intervention\Image\Facades\Image;
	use Intervention\Image\ImageServiceProvider;
	use Validator;
	use File;
	use Carbon\Carbon;
	use App\Mail\projectSubmit;
	use DB;
	use App\Mail\projectApproved;
	use App\Mail\projectDeclined;
	use Share;
	use App\Http\Requests\submitProjectRequest;
	use App\Http\Controllers\adminEventController;


	class submitProjectController extends Controller {
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */

		public function __construct( Request $request, SocialController $social ) {
			$this->middleware( 'auth' );
			$this->submitProject = 'submitProject';
			$this->request       = $request;
		}

		public function index() {

			$event_id         = $this->request->segment( 1 );
			$form             = $this->request->segment( 3 );
			$event            = adminEvent::find( $event_id );
			$cur_date         = $this->check_date();
			$projformondate   = Carbon::parse( $event->projRegFormOnDate );
			$projformoffdate  = Carbon::parse( $event->projRegFormOffDate );
			$projformOverride = $event->projRegFormOverride;
			$user             = Auth::user();
			$user_role        = $user->roles->first();
			$user_role        = $user_role->name;

			$event->curdate = $cur_date;

			if ( $cur_date > $event->event_end_date ) {

				return view( 'partials.eventformoff' )->with( array( 'events' => $event, ) );
			} else {

				if ( $cur_date->between( $projformondate, $projformoffdate ) != true && $projformOverride != '1' && $user_role != 'Admin' && $user_role != 'City Admin' ) {

					if ( $cur_date->lt( $projformondate ) ) {

						return view( 'partials.comingsoon' )->with( array( 'events' => $event, ) );

					} else {

						return view( 'partials.projectformoff' )->with( array( 'events' => $event, ) );

					}

				} else {

					$neighborhood = $this->get_neighborhood();

					$project = array();

					return view( 'project.submitProject' )->with( array(
						'neighborhood' => $neighborhood,
						"event_id"     => $event_id,
						"events"       => $event,
						"form"         => $form,
					) );

				}
			}

		}

		public function store( submitProjectRequest $request ) {

			$event_id = $this->request->segment( 1 );

			$input = $request;

			$event = $this->event( $event_id );
//
			$this->validate( request(), [

				'project_title'           => 'required',
				'proj_description'        => 'required',
				'neighborhood'            => 'required',
				'volunteers_requested'    => 'required',
				'primary_contact_fname'   => 'required',
				'primary_contact_lname'   => 'required',
				'primary_contact_email'   => 'required',
				'primary_contact_phone'   => 'required|max:12',
				'proj_loc_name'           => 'required',
				'proj_loc_street_address' => 'required',
				'proj_loc_zip'            => 'required',


			] );


			$data = $this->get_ais( $input );

			if ( $data == 'nope' ) {

				return Redirect::back()->withErrors( array( 'Oops. We cannot seem to find the project address provided. Please enter a valid address.' ) )->withInput();

			}

			$this->save_project( $request, $data );
			$this->save_contacts( $request, $data );
			$this->save_supplies( $request, $data );
//			$this->email( $input );

			if ( $data != null ) {

//				$this->thank_you( $data );

				$social = $this->social();

				return View( 'partials.projectsuccess' )->with( compact( 'event', 'social' ) );

			}

		}


		private function save_project( $request, $data ) {

			$user_id = Auth::user()->id;

			$record = new submitProject();

			$record->account_owner_id = $user_id;
			$record->project_title    = $request->input( 'project_title' );
			$record->neighborhood     = $request->neighborhood;

			$record->park_rec_fac = $request->input( 'park_rec_fac' );
			if ( ! $record->park_rec_fac ) {

				$record->park_rec_fac = '0';
			}

			$record->comm_cdc_group = $request->input( 'comm_cdc_group' );
			if ( ! $record->comm_cdc_group ) {

				$record->comm_cdc_group = '0';

			}

			$record->comm_cdc_group_name     = $request->input( 'comm_cdc_group_name' );
			$record->volunteers_requested    = $request->input( 'volunteers_requested' );
			$record->proj_loc_name           = $request->input( 'proj_loc_name' );
			$record->proj_loc_street_address = $data['proj_loc_street_address'];
			$record->proj_loc_zip            = $data['proj_loc_zip'];
			$record->private_property        = $request->input( 'private_property' );
			$record->projLong                = $data['X'];
			$record->projLat                 = $data['Y'];
			$record->proj_description        = $request->input( 'proj_description' );
			$record->event_id                = $this->request->segment( 1 );
			$record->active                  = '0';

			$record->save();

		}


		private function save_contacts( $request, $record ) {

			$project = new submitProject();
			$proj_id = $project->get_record_id( $record->proj_loc_street_address );

			$owner = Auth::user();

			$contact_data = new Contacts();

			$contact_data->project_id              = $proj_id;
			$contact_data->account_owner_id        = $owner->id;
			$contact_data->primary_contact_fname   = $request->input( 'primary_contact_fname' );
			$contact_data->primary_contact_lname   = $request->input( 'primary_contact_lname' );
			$contact_data->primary_contact_email   = $request->input( 'primary_contact_email' );
			$contact_data->primary_contact_phone   = $request->input( 'primary_contact_phone' );
			$contact_data->block_captain           = $request->input( 'blockCaptain' );
			$contact_data->alternate_contact_fname = $request->input( 'alternate_contact_fname' );
			$contact_data->alternate_contact_lname = $request->input( 'alternate_contact_lname' );
			$contact_data->alternate_contact_email = $request->input( 'alternate_contact_email' );
			$contact_data->alternate_contact_phone = $request->input( 'alternate_contact_phone' );
			$contact_data->learn_more_zero_waste   = $request->input( 'learn_more_zero_waste' );

			if ( ! $contact_data->learn_more_zero_waste ) {

				$contact_data->learn_more_zero_waste = 'no';

			}

			$contact_data->save();


		}


		private function save_supplies( $request, $record ) {

			$project = new submitProject();
			$proj_id = $project->get_record_id( $record->proj_loc_street_address );

			$supplies = new Supplies();

			$supplies->bags       = $request->input( 'bags' );
			$supplies->gloves     = $request->input( 'gloves' );
			$supplies->brooms     = $request->input( 'brooms' );
			$supplies->rakes      = $request->input( 'rakes' );
			$supplies->shovels    = $request->input( 'shovels' );
			$supplies->paint      = $request->input( 'paint' );
			$supplies->project_id = $proj_id;

			$supplies->save();


		}


		private function get_ais( $data ) {

			if ( ! empty( $data ) ) {

				$address = rawurlencode( $data['proj_loc_street_address'] );

				$url = '' . $address;
				$url .= '';

				$curl = curl_init();
				curl_setopt( $curl, CURLOPT_URL, $url );
				curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );  // TODO SECURITY -> REMOVE THIS LINE WHEN LIVE

				$result = curl_exec( $curl );

				curl_close( $curl );

				$obj = json_decode( $result );

				if ( property_exists( $obj, 'status' ) ) {

					if ( $obj->status == '404' ) {

						return "nope";

					}
				} else {

					$properties = $obj->features[0]->properties;
					$geo        = $obj->features[0]->geometry->coordinates;
					$long       = $geo[0];
					$latt       = $geo[1];

					if ( $obj->search_type == 'intersection' ) {

						$data['proj_loc_street_address'] = $obj->features[0]->street_address;

					} else {

						$data['proj_loc_street_address'] = $properties->street_address;
						$data['proj_loc_zip']            = $properties->zip_code;

					}

					if ( $geo ) {

						$data['X'] = $long;
						$data['Y'] = $latt;


						return $data;

					}


				}
			}

		}


		public function thank_you( $data ) {

			$date           = new DateTime();
			$date           = $date->format( 'Y-m-d H:i:s' );
			$projectTitle   = $data['projectTitle'];
			$projLocAddress = $data['projLocAddress'];

			echo " <div class='alert alert-success'>
               <strong>Success!</strong>
               </div>
               <h4>Thank you for submitting your request project and helping to keep our  beautiful.</h4><br><br>";

			echo "

 <table class='table'>
    <tbody>
        <tr>
        <td><h4>Project Name:</h4></td>
        <td><h4>$projectTitle</h4></td>

    </tr>
    <tr>
        <td><h4>Address:</h4></td>
        <td><h4>$projLocAddress</h4></td>
    </tr>
    </tbody>
</table>";

			die;


		}

		public function edit( $event_id, $project_id ) {

			$form = $this->request->segment( 3 );

			$events = $this->event();

			$event_id = $events->id;

			$id = $project_id;

			$project = submitProject::where( 'project.id', $id )
			                        ->leftJoin( 'project_contacts', 'project_contacts.project_id', '=', 'project.id' )
			                        ->leftJoin( 'supplies', 'supplies.project_id', '=', 'project.id' )
			                        ->first();

			if ( $project->comm_cdc_group == 'no' ) {

				$project->comm_cdc_group = '0';

			}

			if ( $project->park_rec_fac == 'no' ) {

				$project->park_rec_fac = '0';

			}

			$project['id'] = $id;

			$project['imagePath'] = $this->get_image( $id );

			$neighborhood = Neighborhood::pluck( 'neighborhood', 'id' );

			//$project = submitProject::findOrFail( $id );

			return view( 'project.edit', compact( 'project', 'neighborhood', 'event_id', 'events', 'form' ) );


		}

		public function update( $project_id, Request $request, $active ) {

			$id       = $this->request->segment( 3 );
			$event_id = $this->request->segment( 1 );

			$owner = Auth::user();
			$input = Input::all();

			$image = Input::file( 'image' );

			if ( $image != null ) {

				$realPath = $image->getRealPath();
				$name     = $image->getClientOriginalName();
				$ext      = substr( $name, - 4 );
				$path     = $realPath . '/' . $name;

				$image = Image::make( Input::file( 'image' ) );
				File::exists( public_path() . '/images/' ) or File::makeDirectory( public_path() . '/images/' );
				File::exists( public_path() . '/images/project/' ) or File::makeDirectory( public_path() . '/images/project/' );
				File::exists( public_path() . '/images/project/thumbnails/' ) or File::makeDirectory( public_path() . '/images/project/thumbnails/' );
//			File::exists( public_path() . '/images/thumbnails/' ) or File::makeDirectory( public_path() . '/images/thumbnails/' );

				$image->save( public_path() . '/images/project/' . $owner->id . '-' . $id . $ext )
				      ->resize( 100, null, function ( $constraint ) {
					      $constraint->aspectRatio();
				      } )
				      ->save( public_path() . '/images/project/thumbnails/thumb-' . $owner->id . '-' . $id . $ext );

//			return $image->response();

			}


			$data = $this->get_ais( $request );

			if ( $data == 'nope' ) {

				return Redirect::back()->withErrors( array( 'Oops. We cannot seem to find the project address provided. Please enter a valid address.' ) )->withInput();

			}

			$record = submitProject::findOrFail( $id );

			$record->project_title = $request->input( 'project_title' );
			$record->neighborhood  = $request->input( 'neighborhood' );


			if ( $active == 2 ) {

				$record->active = 0;
			}


			$record->park_rec_fac         = $request->input( 'park_rec_fac' );
			$record->comm_cdc_group       = $request->input( 'comm_cdc_group' );
			$record->comm_cdc_group_name  = $request->input( 'comm_cdc_group_name' );
			$record->volunteers_requested = $request->input( 'volunteers_requested' );
			$record->proj_loc_name        = $request->input( 'proj_loc_name' );
			$record->proj_description     = $request->input( 'proj_description' );

			$record->proj_loc_street_address = $request->input( 'proj_loc_street_address' );

			$record->proj_loc_zip     = $request->input( 'proj_loc_zip' );
			$record->private_property = $request->input( 'private_property' );
			$record->projLong         = $data['X'];
			$record->projLat          = $data['Y'];

			$record->update();

			$contact_data = Contacts::where( 'project_id', '=', $id )->first();

			$contact_data->primary_contact_fname   = $request->input( 'primary_contact_fname' );
			$contact_data->primary_contact_lname   = $request->input( 'primary_contact_lname' );
			$contact_data->primary_contact_email   = $request->input( 'primary_contact_email' );
			$contact_data->primary_contact_phone   = $request->input( 'primary_contact_phone' );
			$contact_data->block_captain           = $request->input( 'blockCaptain' );
			$contact_data->alternate_contact_fname = $request->input( 'alternate_contact_fname' );
			$contact_data->alternate_contact_lname = $request->input( 'alternate_contact_lname' );
			$contact_data->alternate_contact_email = $request->input( 'alternate_contact_email' );
			$contact_data->alternate_contact_phone = $request->input( 'alternate_contact_phone' );
			$contact_data->learn_more_zero_waste   = $request->input( 'learn_more_zero_waste' );

			$contact_data->update();

			$supplies = Supplies::where( 'project_id', '=', $id )->first();

			if ( $supplies == null ) {

				$supplies = new Supplies();
			}

			$supplies->bags           = $request->input( 'bags' );
			$supplies->gloves         = $request->input( 'gloves' );
			$supplies->brooms         = $request->input( 'brooms' );
			$supplies->rakes          = $request->input( 'rakes' );
			$supplies->shovels        = $request->input( 'shovels' );
			$supplies->paint          = $request->input( 'paint' );
			$supplies->rally_supplies = $request->input( 'rall_supplies' );


			$supplies->update();

			return redirect( $event_id . '/volunteerProject' );


		}

		private function get_neighborhood() {

			$neighborhood = Neighborhood::pluck( 'neighborhood', 'id' );

			return $neighborhood;
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

		public function adminProject() {

			$event_id = $this->request->segment( 1 );

			$events = $this->event();

			$active = $_GET['active'];
			if ( $active == '0' ) {
				$view = 'Pending';
			}
			if ( $active == '1' ) {
				$view = 'Active';
			}
			if ( $active == '2' ) {
				$view = 'Declined';
			}

			$projects = submitProject::where( 'event_id', $event_id )->where( 'active', $active )->get(); //HARDCODED EVENT ID

			foreach ( $projects AS $key => $value ) {

				$neighborhood        = $this->get_neighborhood();
				$value->neighborhood = $neighborhood[ $value->neighborhood ];


			}

			return view( 'project.adminProject', compact( 'projects', 'view', 'events' ) );


		}

		public function activate( $id ) {

			$social = $this->social();

			$project = submitProject::findOrFail( $id );

			$event = $this->event( '1' );

			$primeContact = DB::table( 'project_contacts' )
			                  ->leftJoin( 'users', 'project_contacts.account_owner_id', '=', 'users.id' )
			                  ->where( 'project_contacts.project_id', $project->id )
			                  ->get();


			if ( ! empty( $primeContact[0] ) ) {

				$owner = $primeContact[0];

			}

			$active = $project->active;

			if ( $active == '0' || $active == '1' || $active == '2' ) {

				$project->active = '1';

			} else {

				$project->active = '0';

			}

			$project->update();

			if ( ! empty( $primeContact[0] ) ) {


				if ( $event->emailPrimaryContact == '1' ) {

					\Mail::to( $owner->primary_contact_email )->send( new ProjectApproved( $project, $owner, $social ) );
				}
				if ( $event->emailProjectOwner == '1' ) {

					\Mail::to( $owner->email )->send( new ProjectApproved( $project, $owner, $social ) );
				}
			}

			return Redirect::back()->with( 'view', 'Active' );

		}

		public function decline(  Request $request ) {


			$id = Input::get('id');

			$project = submitProject::findOrFail( $id );

			$event = $this->event( '1' );

			$primeContact = DB::table( 'project_contacts' )
			                  ->leftJoin( 'users', 'project_contacts.account_owner_id', '=', 'users.id' )
			                  ->where( 'project_contacts.project_id', $project->id )
			                  ->get();


			if ( ! empty( $primeContact[0] ) ) {

				$owner = $primeContact[0];

			}


//			$deck = 'decline';

			$decline = $project->active;

			if ( $decline == '2' ) {

				$project->active = '0';
				$project->rejection_reason = $request->input('rejection_reason');


			} else {

				$project->active = '2';
				$project->rejection_reason = $request->input('rejection_reason');

			}

			$project->update();

			if ( ! empty( $owner ) ) {


				if ( $event->emailPrimaryContact == '1' ) {
					\Mail::to( $owner->primary_contact_email )->send( new ProjectDeclined( $project, $owner ) );
				}
				if ( $event->emailProjectOwner == '1' ) {
					\Mail::to( $owner->email )->send( new ProjectDeclined( $project, $owner ) );
				}
			}

			return Redirect::back()->with( 'view', 'Declined' );


		}

		private function event( $id = null ) {

			if ( is_numeric( $this->request->segment( 1 ) ) ) {

				$event_id = $this->request->segment( 1 );

			} else {

				$event_id = $id;
			}

			$event = adminEvent::where( 'id', $event_id )->first();

			$event->imagePath = $this->get_image( $event->id );

			return $event;

		}

		private function email( $project ) {

			$user   = Auth::user();
			$admin  = $this->event();
			$admins = $admin->projRegAdminEmail;
			$admins = explode( ',', $admins );

			/*mail to project sponsor*/
			if ( $admin->emailProjectOwnerSubmittal == '1' ) {
				\Mail::to( $user->email )->send( new ProjectSubmit( $project, $user ) );
			}
			/*mail to admins*/

			foreach ( $admins as $key => $value ) {

				\Mail::to( $value )->send( new ProjectSubmit( $project, $user ) );

			}

		}

		public function social() {

			$event = $this->event( 1 ); //hardcoded event

			$links = Share::page( 'http://www..com/-spring-up/', $event->event_name )
			              ->facebook()
			              ->twitter()
			              ->googlePlus()
			              ->linkedin( 'Extra linkedin summary can be passed here' );

			return $links;

		}

		public function shortForm() {

			$form = $this->request->segment( 3 );

			return $this->index();


		}


	}
