<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Share;
	use App\submitProject;
	use App\Contacts;
	use App\Mail\projectVoucher;
	use App\adminEvent;

	class SocialController extends Controller {

		public function __construct() {

//			$this->social = $this->social();

		}

		public function social( $event ) {

			echo $event->event_name;

			$links = Share::page( 'http://jorenvanhocht.be', 'Share title' )
			              ->facebook()
			              ->twitter()
			              ->googlePlus()
			              ->linkedin( 'Extra linkedin summary can be passed here' );

			return $links;

		}

		public function voucher() {

			$event = adminEvent::where( 'id', 1 )->first();

			$projects = submitProject::where( 'event_id', $event->id )->where( 'active', 1 )->get();

			foreach ( $projects AS $project ) {

				$owner_id = $project->account_owner_id;

				$contacts = Contacts::where( 'id', $owner_id )->get();

				$email = $contacts->pluck( 'primary_contact_email' );

				if ( ! empty( $contacts ) ) {

					echo "Sent: ".$project->project_title . "<br>";

					$project->pin = 'pn' . $project->id . 'X' . $owner_id;

					\Mail::to( $email )->send( new ProjectVoucher( $project, $contacts, $event ) );

				}

			}

		}


	}
